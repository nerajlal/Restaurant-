<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    public function index(Request $request)
    {
        // Date Range Logic
        $range = $request->get('range', 'today');
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');

        if ($startDate && $endDate) {
            $start = Carbon::parse($startDate)->startOfDay();
            $end = Carbon::parse($endDate)->endOfDay();
            $rangeLabel = $start->format('M d, Y') . ' - ' . $end->format('M d, Y');
        } else {
            switch ($range) {
                case 'today':
                    $start = Carbon::today();
                    $end = Carbon::today()->endOfDay();
                    $rangeLabel = 'Today';
                    break;
                case 'this_week':
                    $start = Carbon::now()->startOfWeek();
                    $end = Carbon::now()->endOfWeek();
                    $rangeLabel = 'This Week';
                    break;
                case 'this_month':
                    $start = Carbon::now()->startOfMonth();
                    $end = Carbon::now()->endOfMonth();
                    $rangeLabel = 'This Month';
                    break;
                case '6_months':
                    $start = Carbon::today()->subMonths(6)->startOfDay();
                    $end = Carbon::today()->endOfDay();
                    $rangeLabel = 'Last 6 Months';
                    break;
                case '1_year':
                    $start = Carbon::today()->subYear()->startOfDay();
                    $end = Carbon::today()->endOfDay();
                    $rangeLabel = 'Last 1 Year';
                    break;
                default:
                    $start = Carbon::today();
                    $end = Carbon::today()->endOfDay();
                    $rangeLabel = 'Today';
                    break;
            }
        }

        // Base Query for Completed Orders
        $ordersQuery = Order::whereIn('status', ['confirmed', 'preparing', 'ready', 'served'])
            ->whereBetween('created_at', [$start, $end]);

        // Key Metrics
        $totalRevenue = (clone $ordersQuery)->sum('total_amount');
        $totalOrders = (clone $ordersQuery)->count();
        $averageOrderValue = $totalOrders > 0 ? $totalRevenue / $totalOrders : 0;

        // Revenue Trend Chart Data (Daily)
        $revenueTrend = [];
        $period = new \DatePeriod($start, new \DateInterval('P1D'), $end); // Iterate daily

        // Fetch daily sums to map
        $dailyRevenues = Order::whereIn('status', ['confirmed', 'preparing', 'ready', 'served'])
            ->whereBetween('created_at', [$start, $end])
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(total_amount) as total'))
            ->groupBy('date')
            ->pluck('total', 'date');

        foreach ($period as $date) {
            $formattedDate = $date->format('Y-m-d');
            $revenueTrend[] = [
                'date' => $date->format('M d'),
                'revenue' => $dailyRevenues[$formattedDate] ?? 0
            ];
        }
        // Handle the end date specifically if it's today and not covered by DatePeriod iteration logic fully in some PHP versions
        if ($start->diffInDays($end) == 0) {
             // For single day (Today), maybe show hourly? For now, just show the single day point or empty
             // Let's keep it simple: date -> revenue
             $formattedDate = $start->format('Y-m-d');
             $revenueTrend = [[
                 'date' => $start->format('M d'),
                 'revenue' => $dailyRevenues[$formattedDate] ?? 0
             ]];
        }


        // Orders by Category (Pie Chart)
        $categorySales = OrderItem::whereHas('order', function ($q) use ($start, $end) {
                $q->whereIn('status', ['confirmed', 'preparing', 'ready', 'served'])
                  ->whereBetween('created_at', [$start, $end]);
            })
            ->join('menu_items', 'order_items.menu_item_id', '=', 'menu_items.id')
            ->join('categories', 'menu_items.category_id', '=', 'categories.id')
            ->select('categories.name', DB::raw('SUM(order_items.quantity) as total_qty'))
            ->groupBy('categories.name')
            ->get();
        
        $categoryLabels = $categorySales->pluck('name');
        $categoryData = $categorySales->pluck('total_qty');

        // Top Selling Items
        $topItems = OrderItem::whereHas('order', function ($q) use ($start, $end) {
                $q->whereIn('status', ['confirmed', 'preparing', 'ready', 'served'])
                  ->whereBetween('created_at', [$start, $end]);
            })
            ->select('name', DB::raw('SUM(quantity) as total_qty'), DB::raw('SUM(price * quantity) as total_revenue'))
            ->groupBy('name')
            ->orderByDesc('total_qty')
            ->take(10)
            ->get();

        // === NEW METRICS ===
        
        // Total Items Sold
        $totalItemsSold = OrderItem::whereHas('order', function ($q) use ($start, $end) {
                $q->whereIn('status', ['confirmed', 'preparing', 'ready', 'served'])
                  ->whereBetween('created_at', [$start, $end]);
            })->sum('quantity');

        // Active Tables (tables with pending/preparing/ready orders)
        $activeTables = Order::whereIn('status', ['pending', 'confirmed', 'preparing', 'ready'])
            ->whereBetween('created_at', [$start, $end])
            ->distinct('table_id')
            ->count('table_id');

        // Order Status Breakdown
        $allOrders = Order::whereBetween('created_at', [$start, $end]);
        $orderStatusCounts = [
            'pending' => (clone $allOrders)->where('status', 'pending')->count(),
            'confirmed' => (clone $allOrders)->where('status', 'confirmed')->count(),
            'preparing' => (clone $allOrders)->where('status', 'preparing')->count(),
            'ready' => (clone $allOrders)->where('status', 'ready')->count(),
            'served' => (clone $allOrders)->where('status', 'served')->count(),
        ];
        
        $totalAllOrders = array_sum($orderStatusCounts);
        $completedOrders = $orderStatusCounts['served'];
        $completionRate = $totalAllOrders > 0 ? round(($completedOrders / $totalAllOrders) * 100, 1) : 0;

        // Hourly Order Distribution
        $hourlyOrders = Order::whereBetween('created_at', [$start, $end])
            ->select(DB::raw('HOUR(created_at) as hour'), DB::raw('COUNT(*) as count'))
            ->groupBy('hour')
            ->orderBy('hour')
            ->pluck('count', 'hour');

        $hourlyData = [];
        $peakHour = 0;
        $peakCount = 0;
        for ($h = 0; $h < 24; $h++) {
            $count = $hourlyOrders[$h] ?? 0;
            $hourlyData[] = [
                'hour' => sprintf('%02d:00', $h),
                'count' => $count
            ];
            if ($count > $peakCount) {
                $peakCount = $count;
                $peakHour = $h;
            }
        }
        $peakHourLabel = sprintf(
            '%d:00 %s - %d:00 %s',
            $peakHour == 0 ? 12 : ($peakHour > 12 ? $peakHour - 12 : $peakHour),
            $peakHour < 12 ? 'AM' : 'PM',
            ($peakHour + 1) % 24 == 0 ? 12 : (($peakHour + 1) % 24 > 12 ? ($peakHour + 1) % 24 - 12 : ($peakHour + 1) % 24),
            ($peakHour + 1) % 24 < 12 ? 'AM' : 'PM'
        );

        // Table Performance
        $tablePerformance = Order::whereIn('status', ['confirmed', 'preparing', 'ready', 'served'])
            ->whereBetween('created_at', [$start, $end])
            ->select('table_name', DB::raw('COUNT(*) as order_count'), DB::raw('SUM(total_amount) as revenue'))
            ->groupBy('table_name')
            ->orderByDesc('revenue')
            ->take(10)
            ->get();

        // Category Revenue (not just quantity)
        $categoryRevenue = OrderItem::whereHas('order', function ($q) use ($start, $end) {
                $q->whereIn('status', ['confirmed', 'preparing', 'ready', 'served'])
                  ->whereBetween('created_at', [$start, $end]);
            })
            ->join('menu_items', 'order_items.menu_item_id', '=', 'menu_items.id')
            ->join('categories', 'menu_items.category_id', '=', 'categories.id')
            ->select('categories.name', DB::raw('SUM(order_items.price * order_items.quantity) as total_revenue'))
            ->groupBy('categories.name')
            ->orderByDesc('total_revenue')
            ->get();
        
        $categoryRevenueLabels = $categoryRevenue->pluck('name');
        $categoryRevenueData = $categoryRevenue->pluck('total_revenue');

        // Daily Order Count Trend
        $orderCountTrend = [];
        $dailyOrderCounts = Order::whereBetween('created_at', [$start, $end])
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as count'))
            ->groupBy('date')
            ->pluck('count', 'date');

        foreach ($period as $date) {
            $formattedDate = $date->format('Y-m-d');
            $orderCountTrend[] = [
                'date' => $date->format('M d'),
                'count' => $dailyOrderCounts[$formattedDate] ?? 0
            ];
        }
        if ($start->diffInDays($end) == 0) {
            $formattedDate = $start->format('Y-m-d');
            $orderCountTrend = [[
                'date' => $start->format('M d'),
                'count' => $dailyOrderCounts[$formattedDate] ?? 0
            ]];
        }

        return view('admin.analytics.index', compact(
            'totalRevenue', 
            'totalOrders', 
            'averageOrderValue', 
            'revenueTrend', 
            'categoryLabels', 
            'categoryData', 
            'topItems',
            'rangeLabel',
            'range',
            'startDate',
            'endDate',
            // New metrics
            'totalItemsSold',
            'activeTables',
            'orderStatusCounts',
            'completionRate',
            'hourlyData',
            'peakHourLabel',
            'tablePerformance',
            'categoryRevenueLabels',
            'categoryRevenueData',
            'orderCountTrend'
        ));
    }
}

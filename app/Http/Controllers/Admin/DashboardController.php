<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\MenuItem;
use App\Models\Reservation;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Table;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Basic counts
        $totalReservations = Reservation::count();
        $totalMenuItems = MenuItem::count();
        $totalCategories = Category::count();
        $totalTables = Table::count();
        
        // Revenue statistics
        $totalRevenue = Order::whereIn('status', ['confirmed', 'preparing', 'ready', 'served'])->sum('total_amount');
        $todayRevenue = Order::whereIn('status', ['confirmed', 'preparing', 'ready', 'served'])
            ->whereDate('created_at', today())
            ->sum('total_amount');
        
        // Order statistics
        $todayOrders = Order::whereDate('created_at', today())->count();
        $totalOrders = Order::count();
        
        // Order counts by status
        $pendingOrders = Order::where('status', 'pending')->count();
        $confirmedOrders = Order::where('status', 'confirmed')->count();
        $preparingOrders = Order::where('status', 'preparing')->count();
        $readyOrders = Order::where('status', 'ready')->count();
        $servedOrders = Order::where('status', 'served')->count();
        
        // Active tables (tables with pending/confirmed/preparing/ready orders)
        $activeTables = Order::whereIn('status', ['pending', 'confirmed', 'preparing', 'ready'])
            ->distinct('table_id')
            ->count('table_id');
        
        // Average order value
        $averageOrderValue = Order::whereIn('status', ['confirmed', 'preparing', 'ready', 'served'])
            ->avg('total_amount') ?? 0;
        
        // Revenue trend for last 7 days
        $revenueTrend = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $revenue = Order::whereIn('status', ['confirmed', 'preparing', 'ready', 'served'])
                ->whereDate('created_at', $date)
                ->sum('total_amount');
            $revenueTrend[] = [
                'date' => $date->format('M d'),
                'revenue' => $revenue
            ];
        }
        
        // Top selling items (top 5)
        $topSellingItems = OrderItem::select('name', DB::raw('SUM(quantity) as total_quantity'))
            ->groupBy('name')
            ->orderByDesc('total_quantity')
            ->take(5)
            ->get();
        
        // Recent orders (last 10)
        $recentOrders = Order::with('items')
            ->latest()
            ->take(10)
            ->get();
        
        // Recent reservations (last 5)
        $recentReservations = Reservation::latest()->take(5)->get();
        
        // Order status distribution for chart
        $orderStatusDistribution = [
            'pending' => $pendingOrders,
            'confirmed' => $confirmedOrders,
            'preparing' => $preparingOrders,
            'ready' => $readyOrders,
            'served' => $servedOrders
        ];
        
        // Table utilization percentage
        $tableUtilization = $totalTables > 0 ? round(($activeTables / $totalTables) * 100, 1) : 0;

        return view('admin.dashboard', compact(
            'totalReservations',
            'totalMenuItems',
            'totalCategories',
            'totalTables',
            'totalRevenue',
            'todayRevenue',
            'todayOrders',
            'totalOrders',
            'pendingOrders',
            'confirmedOrders',
            'preparingOrders',
            'readyOrders',
            'servedOrders',
            'activeTables',
            'averageOrderValue',
            'revenueTrend',
            'topSellingItems',
            'recentOrders',
            'recentReservations',
            'orderStatusDistribution',
            'tableUtilization'
        ));
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\MenuItem;
use App\Models\Table;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function live()
    {
        return view('admin.orders.live');
    }

    public function fetchPending(Request $request)
    {
        // Polling logic: Get orders updated or created after last check
        // Or simply get all pending/active orders
        
        $orders = Order::with('items')
            ->whereIn('status', ['pending', 'confirmed', 'preparing', 'ready'])
            ->orderBy('created_at', 'asc') // Oldest first (FIFO)
            ->get();
            
        return response()->json([
            'orders' => $orders,
            'count' => $orders->count(),
            'pending_count' => $orders->where('status', 'pending')->count()
        ]);
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,preparing,ready,served,cancelled'
        ]);

        $order->update(['status' => $request->status]);

        return response()->json(['success' => true]);
    }


    public function history(Request $request)
    {
        $query = Order::with('items');

        // Date range filter
        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        // Status filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Table filter
        if ($request->filled('table')) {
            $query->where('table_name', $request->table);
        }

        // Search by order ID
        if ($request->filled('search')) {
            $query->where('id', 'like', '%' . $request->search . '%');
        }

        $orders = $query->orderBy('created_at', 'desc')->paginate(20);
        $tables = Order::distinct()->pluck('table_name');

        return view('admin.orders.history', compact('orders', 'tables'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'table_id' => 'required|exists:tables,id',
            'items' => 'required|array|min:1',
            'items.*.id' => 'required|exists:menu_items,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        $table = Table::findOrFail($request->table_id);

        $total = 0;
        foreach($request->items as $itemData) {
             $menuItem = MenuItem::find($itemData['id']);
             if($menuItem) {
                 $total += $menuItem->price * $itemData['quantity'];
             }
        }

        $order = Order::create([
            'table_id' => $table->id,
            'table_name' => $table->name,
            'status' => 'confirmed',
            'total_amount' => $total,
            'customer_notes' => $request->notes ?? '',
        ]);

        foreach ($request->items as $itemData) {
             $menuItem = MenuItem::find($itemData['id']);
             if($menuItem) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'menu_item_id' => $menuItem->id,
                    'name' => $menuItem->name,
                    'price' => $menuItem->price,
                    'quantity' => $itemData['quantity'],
                    'notes' => $itemData['notes'] ?? '',
                ]);
             }
        }

        return response()->json(['success' => true, 'order_id' => $order->id]);
    }
}

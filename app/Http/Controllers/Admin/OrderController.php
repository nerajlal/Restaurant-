<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
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
}

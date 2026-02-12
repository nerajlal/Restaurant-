<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuItem;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index()
    {
        $cart = Session::get('cart', []);
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return response()->json(['cart' => $cart, 'total' => $total]);
    }

    public function add(Request $request)
    {
        $item = MenuItem::findOrFail($request->id);
        $cart = Session::get('cart', []);

        if (isset($cart[$item->id])) {
            $cart[$item->id]['quantity']++;
        } else {
            $cart[$item->id] = [
                'id' => $item->id,
                'name' => $item->name,
                'price' => $item->price,
                'quantity' => 1,
                'notes' => ''
            ];
        }

        Session::put('cart', $cart);
        return response()->json(['success' => true, 'cart_count' => count($cart)]);
    }

    public function update(Request $request)
    {
        $cart = Session::get('cart', []);
        
        if(isset($cart[$request->id])) {
            $cart[$request->id]['quantity'] = $request->quantity;
            if ($request->has('notes')) {
                $cart[$request->id]['notes'] = $request->notes;
            }
            if($request->quantity <= 0) {
                unset($cart[$request->id]);
            }
            Session::put('cart', $cart);
        }

        return response()->json(['success' => true]);
    }

    public function remove(Request $request)
    {
        $cart = Session::get('cart', []);
        if(isset($cart[$request->id])) {
            unset($cart[$request->id]);
            Session::put('cart', $cart);
        }
        return response()->json(['success' => true]);
    }

    public function placeOrder(Request $request)
    {
        if (!Session::has('table_id')) {
            return response()->json(['error' => 'Table session expired. Please scan QR again.'], 403);
        }

        $cart = Session::get('cart', []);
        if (empty($cart)) {
            return response()->json(['error' => 'Cart is empty.'], 400);
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        $order = Order::create([
            'table_id' => Session::get('table_id'),
            'table_name' => Session::get('table_name'),
            'status' => 'pending',
            'total_amount' => $total,
            'customer_notes' => $request->notes,
        ]);

        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'menu_item_id' => $item['id'],
                'name' => $item['name'],
                'price' => $item['price'],
                'quantity' => $item['quantity'],
                'notes' => $item['notes'],
            ]);
        }

        Session::forget('cart');

        return response()->json(['success' => true, 'order_id' => $order->id]);
    }
}

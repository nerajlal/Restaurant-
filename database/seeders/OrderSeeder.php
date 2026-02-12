<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Table;
use App\Models\MenuItem;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $tables = Table::all();
        $items = MenuItem::all();

        if ($tables->isEmpty() || $items->isEmpty()) return;

        // Create some past completed orders
        for ($i = 0; $i < 5; $i++) {
            $table = $tables->random();
            $order = Order::create([
                'table_id' => $table->id,
                'table_name' => $table->name,
                'status' => 'served',
                'total_amount' => 0, // Calculated below
                'created_at' => now()->subHours(rand(1, 5)),
            ]);

            $total = 0;
            for ($j = 0; $j < rand(1, 3); $j++) {
                $item = $items->random();
                $qty = rand(1, 2);
                OrderItem::create([
                    'order_id' => $order->id,
                    'menu_item_id' => $item->id,
                    'name' => $item->name,
                    'price' => $item->price,
                    'quantity' => $qty,
                ]);
                $total += $item->price * $qty;
            }
            $order->update(['total_amount' => $total]);
        }

        // Create a LIVE Pending Order (Make it noisy!)
        $liveTable = $tables->first();
        $liveOrder = Order::create([
            'table_id' => $liveTable->id,
            'table_name' => $liveTable->name,
            'status' => 'pending',
            'total_amount' => 0,
            'customer_notes' => 'Urgent! Celebrating birthday.',
            'created_at' => now(), // Just now
        ]);

        $item1 = $items->first();
        OrderItem::create([
            'order_id' => $liveOrder->id,
            'menu_item_id' => $item1->id,
            'name' => $item1->name,
            'price' => $item1->price,
            'quantity' => 1,
        ]);
        $liveOrder->update(['total_amount' => $item1->price]);
    }
}

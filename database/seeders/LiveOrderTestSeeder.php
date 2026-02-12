<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Table;
use App\Models\MenuItem;

class LiveOrderTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure we have a table and an item
        $table = Table::firstOrCreate(
            ['name' => 'Test Table 99'],
            ['token' => 'test-token-99', 'status' => 'active']
        );

        $item = MenuItem::first();
        if (!$item) {
            $this->command->error('No menu items found. Please create menu items first.');
            return;
        }

        // Create a Pending Order
        $order = Order::create([
            'table_id' => $table->id,
            'table_name' => $table->name,
            'status' => 'pending',
            'total_amount' => $item->price * 2,
            'customer_notes' => 'Extra spicy, please! (Test Order)',
            'created_at' => now(),
        ]);

        // Add Items
        OrderItem::create([
            'order_id' => $order->id,
            'menu_item_id' => $item->id,
            'name' => $item->name,
            'price' => $item->price,
            'quantity' => 2,
            'notes' => 'No onions',
        ]);

        $this->command->info('Test Order Created! Check the Admin Dashboard for the BEEP 🔔');
    }
}

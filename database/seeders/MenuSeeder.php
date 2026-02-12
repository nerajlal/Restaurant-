<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\MenuItem;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        // Categories
        $starters = Category::create(['name' => 'Starters', 'is_active' => true]);
        $mains = Category::create(['name' => 'Main Course', 'is_active' => true]);
        $desserts = Category::create(['name' => 'Desserts', 'is_active' => true]);
        $drinks = Category::create(['name' => 'Beverages', 'is_active' => true]);

        // Items
        MenuItem::create([
            'category_id' => $starters->id,
            'name' => 'Crispy Calamari',
            'slug' => \Illuminate\Support\Str::slug('Crispy Calamari'),
            'description' => 'Lightly battered squid rings with garlic aioli.',
            'price' => 12.99,
            'is_vegetarian' => false,
            'is_active' => true,
        ]);

        MenuItem::create([
            'category_id' => $starters->id,
            'name' => 'Vegetable Spring Rolls',
            'slug' => \Illuminate\Support\Str::slug('Vegetable Spring Rolls'),
            'description' => 'Crispy rolls filled with seasoned vegetables.',
            'price' => 8.50,
            'is_vegetarian' => true,
            'is_active' => true,
        ]);

        MenuItem::create([
            'category_id' => $mains->id,
            'name' => 'Grilled Salmon',
            'slug' => \Illuminate\Support\Str::slug('Grilled Salmon'),
            'description' => 'Served with asparagus and lemon butter sauce.',
            'price' => 24.00,
            'is_vegetarian' => false,
            'is_active' => true,
        ]);

        MenuItem::create([
            'category_id' => $mains->id,
            'name' => 'Mushroom Risotto',
            'slug' => \Illuminate\Support\Str::slug('Mushroom Risotto'),
            'description' => 'Creamy Arborio rice with wild mushrooms and parmesan.',
            'price' => 18.00,
            'is_vegetarian' => true,
            'is_active' => true,
        ]);

        MenuItem::create([
            'category_id' => $desserts->id,
            'name' => 'Chocolate Lava Cake',
            'slug' => \Illuminate\Support\Str::slug('Chocolate Lava Cake'),
            'description' => 'Warm chocolate cake with a molten center.',
            'price' => 9.50,
            'is_vegetarian' => true,
            'is_active' => true,
        ]);

        MenuItem::create([
            'category_id' => $drinks->id,
            'name' => 'Mojito',
            'slug' => \Illuminate\Support\Str::slug('Mojito'),
            'description' => 'Fresh mint, lime, rum, and soda water.',
            'price' => 10.00,
            'is_vegetarian' => true,
            'is_active' => true,
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Table;

class TableSeeder extends Seeder
{
    public function run(): void
    {
        // Create 10 Tables
        for ($i = 1; $i <= 10; $i++) {
            Table::create([
                'name' => "Table $i",
                'token' => "table-$i-token",
                'status' => 'active',
            ]);
        }

        // Create a Patio Table
        Table::create([
            'name' => "Patio 1",
            'token' => "patio-1-token",
            'status' => 'active',
        ]);
    }
}

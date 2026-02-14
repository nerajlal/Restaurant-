<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->timestamps();
        });

        // Insert default settings
        DB::table('settings')->insert([
            ['key' => 'restaurant_name', 'value' => 'Test Resto', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'restaurant_address', 'value' => '', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'restaurant_phone', 'value' => '', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'restaurant_email', 'value' => '', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'opening_time', 'value' => '09:00', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'closing_time', 'value' => '22:00', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'tax_rate', 'value' => '0', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'currency', 'value' => 'INR', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};

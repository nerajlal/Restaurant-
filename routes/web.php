<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\MenuItemController;
use App\Http\Controllers\Admin\ReservationController as AdminReservationController;
use App\Http\Controllers\Admin\TableController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\AnalyticsController;
use App\Http\Controllers\CartController;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');
Route::get('/menu/order', [MenuController::class, 'order'])->name('menu.order');
Route::get('/table/{token}', [MenuController::class, 'tableLogin'])->name('table.login'); // QR Login
// Reservation Routes Removed
Route::view('/about', 'about')->name('about');
Route::view('/contact', 'contact')->name('contact');

// Cart Routes
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/place-order', [CartController::class, 'placeOrder'])->name('cart.placeOrder');
Route::post('/cart/place-order-direct', [CartController::class, 'placeOrderDirect'])->name('cart.placeOrderDirect');

// Admin Routes
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/analytics', [AnalyticsController::class, 'index'])->name('analytics.index');
    
    Route::resource('categories', CategoryController::class);
    Route::resource('menu_items', MenuItemController::class);
    
    // Reservations Removed as per request

    // Tables & QR
    Route::resource('tables', TableController::class)->only(['index', 'store', 'destroy']);
    Route::get('/tables/{table}/qr', [TableController::class, 'downloadQr'])->name('tables.download_qr');
    Route::get('/tables/{table}/order', [TableController::class, 'order'])->name('tables.order');

    // Live Orders
    Route::post('/orders/store', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders/live', [OrderController::class, 'live'])->name('orders.live');
    Route::get('/orders/fetch', [OrderController::class, 'fetchPending'])->name('orders.fetch');
    Route::patch('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.update_status');

    Route::get('/qr-code', [App\Http\Controllers\Admin\QrCodeController::class, 'index'])->name('qr_code.index');
    Route::get('/qr-code/download', [App\Http\Controllers\Admin\QrCodeController::class, 'download'])->name('qr_code.download');
});

// Profile Routes (Standard Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

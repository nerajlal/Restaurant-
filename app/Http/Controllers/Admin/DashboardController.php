<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\MenuItem;
use App\Models\Reservation;

class DashboardController extends Controller
{
    public function index()
    {
        $totalReservations = Reservation::count();
        $totalMenuItems = MenuItem::count();
        $totalCategories = Category::count();
        $recentReservations = Reservation::latest()->take(5)->get();

        return view('admin.dashboard', compact('totalReservations', 'totalMenuItems', 'totalCategories', 'recentReservations'));
    }
}

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
        $categoryCount = Category::count();
        $menuItemCount = MenuItem::count();
        $reservationCount = Reservation::where('status', 'pending')->count();

        return view('admin.dashboard', compact('categoryCount', 'menuItemCount', 'reservationCount'));
    }
}

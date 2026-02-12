<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;

class ReservationController extends Controller
{
    public function index()
    {
        return view('reservation');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'guests' => 'required|integer|min:1|max:20',
            'reservation_date' => 'required|date|after:today',
            'reservation_time' => 'required',
        ]);

        Reservation::create($validated);

        return redirect()->back()->with('success', 'Your reservation request has been sent! We will confirm it shortly.');
    }
}

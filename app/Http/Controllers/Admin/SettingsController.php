<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->pluck('value', 'key');
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'restaurant_name' => 'required|string|max:255',
            'restaurant_phone' => 'nullable|string|max:20',
            'restaurant_email' => 'nullable|email|max:255',
            'tax_rate' => 'nullable|numeric|min:0|max:100',
        ]);

        $fields = [
            'restaurant_name',
            'restaurant_address',
            'restaurant_phone',
            'restaurant_email',
            'opening_time',
            'closing_time',
            'tax_rate',
            'currency',
        ];

        foreach ($fields as $field) {
            if ($request->has($field)) {
                Setting::set($field, $request->input($field));
            }
        }

        return redirect()->route('admin.settings.index')->with('success', 'Settings updated successfully.');
    }
}

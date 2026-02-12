<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\MenuItem;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::where('is_active', true)->get();
        $query = MenuItem::where('is_active', true);

        if ($request->has('category')) {
            $query->where('category_id', $request->category);
        }

        $items = $query->with('category')->get();

        return view('menu.index', compact('categories', 'items'));
    }
}

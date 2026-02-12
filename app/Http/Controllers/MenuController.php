<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\MenuItem;
use App\Models\Table;
use Illuminate\Support\Facades\Session;

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
        
        $table = null;
        if (Session::has('table_id')) {
            $table = Table::find(Session::get('table_id'));
        }

        return view('menu.index', compact('categories', 'items', 'table'));
    }

    public function tableLogin($token)
    {
        $table = Table::where('token', $token)->firstOrFail();
        
        Session::put('table_id', $table->id);
        Session::put('table_name', $table->name);
        
        return redirect()->route('menu.index')->with('success', 'Welcome! You are ordering for ' . $table->name);
    }
}

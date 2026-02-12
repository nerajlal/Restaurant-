<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\MenuItem;
use App\Models\WebsiteContent;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::where('is_active', true)->take(6)->get();
        $featuredItems = MenuItem::where('is_active', true)->inRandomOrder()->take(8)->get();
        // $hero = WebsiteContent::where('key', 'hero_section')->first(); // Example

        return view('home', compact('categories', 'featuredItems'));
    }
}

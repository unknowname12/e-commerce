<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home()
    {
        $products = Product::all()->shuffle()->take(6);
        $categories = Category::all();
        return view('home', compact('products', 'categories'));
    }

    public function action()
    {
        return view('action');
    }
}

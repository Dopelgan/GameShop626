<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Genre;
use App\Http\Controllers\Controller;
use App\Product;

class AdminController extends Controller
{
    public function index()
    {
        return view('adminPanel', [
            'products' => Product::get(),
            'genres' => Genre::get(),
            'categories' => Category::get()
        ]);
    }
}

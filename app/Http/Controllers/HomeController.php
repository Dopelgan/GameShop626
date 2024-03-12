<?php

namespace App\Http\Controllers;

use App\Category;
use App\Metascore;
use App\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home', [
            'products' => Product::orderBy('count', 'DESC')->take(8)->get(),
            'categories' => Category::get(),
            'metascore' => Metascore::whereIn('product_id', Product::orderBy('count', 'DESC')->take(8)->pluck('id'))->get(),
            'new' => Product::orderBy('year', 'DESC')->take(3)->get()
        ]);
    }

    public function home()
    {
        return view('home', [
            'popular' => Product::orderBy('count', 'DESC')->take(5)->get(),
            'categories' => Category::get(),
            'metascore' => Metascore::whereIn('product_id', Product::orderBy('count', 'DESC')->take(5)->pluck('id'))->orWhereIn('product_id', Product::orderBy('year', 'DESC')->take(3)->pluck('id'))->get(),
            'newest' => Product::orderBy('year', 'DESC')->take(3)->get(),
        ]);
    }
}

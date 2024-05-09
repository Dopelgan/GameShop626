<?php

namespace App\Http\Controllers;

use App\Category;
use App\Metascore;
use App\Product;

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
            'popular' => Product::leftJoin('metascores', 'products.id', '=', 'metascores.product_id')->orderBy('count', 'DESC')->take(5)->get(),
            'categories' => Category::get(),
            'newest' => Product::leftJoin('metascores', 'products.id', '=', 'metascores.product_id')->orderBy('year', 'DESC')->take(3)->get(),
        ]);
    }

    public function home()
    {
        return view('home', [
            'popular' => Product::leftJoin('metascores', 'products.id', '=', 'metascores.product_id')->orderBy('count', 'DESC')->take(5)->get(),
            'categories' => Category::get(),
            'newest' => Product::leftJoin('metascores', 'products.id', '=', 'metascores.product_id')->orderBy('year', 'DESC')->take(3)->get(),
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Category;
use App\Metascore;
use App\Product;

class HomeController extends Controller
{
    protected $product;

    public function __construct(Product $product)
    {
        $this->middleware('auth');
        $this->product = $product;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function home()
    {
        return view('index', [
            'popular' => $this->product->getPopularProducts(),
            'newest' => $this->product->getNewestProducts(),
        ]);
    }
}

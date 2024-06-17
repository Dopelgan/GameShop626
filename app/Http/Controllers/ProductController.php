<?php

namespace App\Http\Controllers;

use App\Basket;
use App\Category;
use App\Metascore;
use App\Product;
use App\ProductGenre;
use App\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{

    public function show(Request $request)
    {
        $product = Product::with('genres', 'metascore')->find($request->id);
        $product->count++;
        $product->save();

        return view('product', [
            'product' => $product,
            'popular' => Product::getPopularProducts()
        ]);

    }

}

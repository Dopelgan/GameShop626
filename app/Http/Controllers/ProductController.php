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

class ProductController extends UserController
{
    public function show(Request $request)
    {
        $product_id = $request->id;

        $product = Product::find($product_id);
        $product->count++;
        $product->save();

        return view('product', [
            'product' => $product,
            'genres' => Genre::whereIn('id', ProductGenre::where('product_id', $product_id)->pluck('genre_id'))->get(),
            'metascore' => Metascore::where('product_id', $product_id)->first(),
            'popular' => Product::leftJoin('metascores', 'products.id', '=', 'metascores.product_id')
                ->orderBy('count', 'DESC')
                ->take(5)
                ->get(),
        ]);
    }
}

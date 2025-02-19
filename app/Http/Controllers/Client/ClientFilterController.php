<?php

namespace App\Http\Controllers\Client;

use App\Category;
use App\Genre;
use App\Http\Controllers\Controller;
use App\Product;
use App\ProductGenre;
use Illuminate\Http\Request;

class ClientFilterController extends Controller
{
    public function filter(Request $request)
    {
        $query = Product::query()->leftJoin('metascores', 'products.id', '=', 'metascores.product_id');

        if (isset($request['search'])) {
            $query->where('name', 'like', "%{$request['search']}%");
        }
        if (isset($request['category_id'])) {
            $query->where('category_id', $request['category_id']);
        }
        if (isset($request['genre_id'])) {
            $query->whereIn('products.id', ProductGenre::whereIn('genre_id', $request['genre_id'])->pluck('product_id'));
        }
        if (isset($request['priceRange'])) {
            $query->where('price', '<=', $request['priceRange']);
        }
        if (isset($request['order_by']) & $request['order_by'] == 'count') {
            $query->orderBy('count', 'DESC');
        }
        if (isset($request['order_by']) & $request['order_by'] == 'name') {
            $query->orderBy('name');
        }
        if (isset($request['order_by']) & $request['order_by'] == 'maxPrice') {
            $query->orderBy('price', 'DESC');
        }
        if (isset($request['order_by']) & $request['order_by'] == 'minPrice') {
            $query->orderBy('price');
        }
        if (isset($request['order_by']) & $request['order_by'] == 'metaScore'){
            $query->orderBy('meta_score', 'desc');
        }
        if (isset($request['order_by']) & $request['order_by'] == 'userScore'){
            $query->orderBy('user_score', 'desc');
        }

        return view('filter', [
            'filter' => $query->get(),
            'genres' => Genre::get(),
            'categories' => Category::get(),
            'maxPrice' => Product::max('price'),
            'minPrice' => Product::min('price'),
        ]);
    }

}


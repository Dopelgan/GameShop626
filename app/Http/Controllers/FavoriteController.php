<?php

namespace App\Http\Controllers;

use App\Favorite;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FavoriteController extends Controller
{
    public function favorites()
    {
        return view('favorites', [
                'products' => Product::whereIn('id', Favorite::where('user_id', Auth::user()->id)->pluck('product_id'))->get()
            ]
        );
    }

    public function addToFavorite(Request $request)
    {
        Favorite::FirstOrCreate(
            ['product_id' => $request->product_id, 'user_id' => Auth::user()->id],
            ['product_id' => $request->product_id, 'user_id' => Auth::user()->id]
        );

        return back();
    }

    public function deleteFavorite(Request $request)
    {
        Favorite::where('user_id', Auth::user()->id)->where('product_id', "$request->product_id")->delete();

        return back();
    }

    public function clearFavorites()
    {
        Favorite::where('user_id', Auth::user()->id)->delete();

        return back();
    }
}

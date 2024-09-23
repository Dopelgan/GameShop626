<?php

namespace App\Http\Controllers;

use App\Favorite;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        return redirect()->back()->with('success', 'Товар добавлен в избранное.');
    }

    public function deleteFromFavorite(Request $request)
    {
        Favorite::where('user_id', Auth::user()->id)->where('product_id', "$request->product_id")->delete();

        return redirect()->back()->with('success', 'Товар удален из избранного.');
    }

    public function clearFavorites()
    {
        Favorite::where('user_id', Auth::user()->id)->delete();

        return redirect()->back()->with('success', 'Избранное очищено.');
    }
}

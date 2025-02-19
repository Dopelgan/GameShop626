<?php

namespace App\Http\Controllers\Client;

use App\Favorite;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientFavoriteController extends Controller
{
    public function index()
    {
        return view('favorites', [
                'products' => Product::whereIn('id', Favorite::where('user_id', Auth::user()->id)->pluck('product_id'))->get(),
            ]
        );
    }

    public function store(Request $request)
    {
        Favorite::FirstOrCreate(
            ['product_id' => $request->product_id, 'user_id' => Auth::user()->id],
            ['product_id' => $request->product_id, 'user_id' => Auth::user()->id]
        );

        return redirect()->back()->with('success', 'Товар добавлен в избранное.');
    }

    public function destroy($id)
    {
        Favorite::where('user_id', Auth::user()->id)->where('product_id', $id)->delete();

        return redirect()->back()->with('success', 'Товар удален из избранного.');
    }

    public function clear()
    {
        Favorite::where('user_id', Auth::user()->id)->delete();

        return redirect()->back()->with('success', 'Избранное очищено.');
    }
}

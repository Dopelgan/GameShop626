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
        return view('favorites',[
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

    public function delete_from_favorites(Request $request)
    {
        $deletedRows = DB::table('favorites')
            ->where('user_name', 'Admin')
            ->where('game_name', "$request->game_name")
            ->delete();

        return redirect('favorites');
    }

    public function clear_favorites()
    {
        DB::table('favorites')->where('user_name', 'Admin')->delete();

        return response()->json();
    }
}

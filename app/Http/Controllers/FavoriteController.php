<?php

namespace App\Http\Controllers;

use App\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FavoriteController extends Controller
{
    public function favorites()
    {
        $games_in_favorites = DB::table('favorites')->where('user_name', 'Admin')->get();
        $pluck = DB::table('favorites')->where('user_name', 'Admin')->pluck('game_name');
        $games = DB::table('games')->whereIn('name', $pluck)->get();

        return view('favorites', [
            'games' => $games
        ]);
    }

    public function addToFavorite(Request $request)
    {
        Favorite::FirstOrCreate(
            ['product_id' => $request->product_id, 'user_id' => $request->user_id],
            ['product_id' => $request->product_id, 'user_id' => $request->user_id]
        );

        return redirect($request->page);
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

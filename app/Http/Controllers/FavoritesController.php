<?php

namespace App\Http\Controllers;

use App\Favorites;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FavoritesController extends Controller
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

    public function add_favorite(Request $request)
    {
//        dd($request->all());
        $find_game = DB::table('games')->where('name', $request->game_name)->get();
        $need_game = $find_game[0];

        $need_genres = DB::table('game_genres')->where('game_name', $request->game_name)->pluck('genre_name');

        $add_game_to_basket = Favorites::FirstOrCreate(

            ['game_name' => $request->game_name, 'user_name' => $request->user_name],

            ['game_name' => $request->game_name, 'user_name' => $request->user_name]

        );

        return redirect("game_page/$need_game->name");
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
        $deletedRows = DB::table('favorites')->where('user_name', 'Admin')->delete();

        return redirect('favorites');
    }
}

<?php

namespace App\Http\Controllers;

use App\Basket;
use App\Game;
use App\GameGenre;
use App\GamePlatform;
use App\Genre;
use App\Platform;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GameController extends UserController
{
    public function home()
    {
        $games = DB::table('games')->get();
        $platforms = DB::table('platforms')->get();
        return view('home', [
            'games' => $games,
            'platforms' => $platforms,
        ]);
    }

//    public function game_page(Request $request)
//    {
//        $find_game = DB::table('games')->where('name', $request->game_name)->get();
//        $need_game = $find_game[0];
//
//        $need_genres = DB::table('game_genres')->where('game_name', $request->game_name)->pluck('genre_name');
//
//        $post = Game::find($need_game->id);
//        $post->count++;
//        $post->save();
//
//        return view('game_page', [
//            'need_game' => $need_game,
//            'need_genres' => $need_genres
//        ]);
//    }



//    public function platform_game(Request $request)
//    {
//        $genres = Genre::get();
//        $platforms = Platform::get();
//        $games = Game::select();
//
//        $need_games = DB::table('games_platform')->where('platform_name', $request->platform_name)->value('game_name');
//
//        if($need_games!=null){
//
//        }
//
//
//        return view('home', [
//            'games' => $games,
//            'genres' => $genres,
//            'platforms' => $platforms
//        ]);
//    }
}

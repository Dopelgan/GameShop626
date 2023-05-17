<?php

use App\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'GameController@home')->name('home');
Route::get('/test', 'AdminController@test')->name('test');
Route::get('/change_test', 'AdminController@change_test')->name('change_test');
Route::get('/home', 'GameController@home')->name('home');
Route::get('/basket', 'BasketController@basket')->name('basket');
Route::any('/game_page/{game_name}', function ($game_name) {

    $find_game = DB::table('games')->where('name', $game_name)->get();

    $need_genres = DB::table('game_genres')->where('game_name', $game_name)->pluck('genre_name');

    $change = Game::find($find_game[0]->id);
    $change->count++;
    $change->save();

    return view('game_page', [
        'need_game' => $find_game[0],
        'need_genres' => $need_genres
    ]);

})->name('game_page');

Route::any('/platform/{name}', function ($name) {

    $find_platform = DB::table('platforms')->where('name', $name)->get();
    $games_name = DB::table('game_platforms')->where('platform_name', $name)->pluck('game_name');
    $games = DB::table('games')->whereIn('name', $games_name)->get();

    return view('platform', [
        'platform' => $find_platform[0],
        'games' => $games,
    ]);
});

Route::post('/platform_game', 'GameController@platform_game')->name('platform_game');
Route::post('/add_game_to_basket', 'BasketController@add_game_to_basket')->name('add_game_to_basket');
Route::post('/clear_basket', 'BasketController@clear_basket')->name('clear_basket');
Route::post('/change_amount_game_to_basket', 'BasketController@change_amount_game_to_basket')->name(
    'change_amount_game_to_basket'
);
Route::post('/add_game', 'AdminController@add_game')->name('add_game');
Route::post('/add_genre', 'AdminController@add_genre')->name('add_genre');
Route::post('/add_platform', 'AdminController@add_platform')->name('add_platform');
Route::post('/game_genre', 'AdminController@game_genre')->name('game_genre');
Route::post('/game_platform', 'AdminController@game_platform')->name('game_platform');
Route::post('/change_description', 'AdminController@change_description')->name('change_description');
Route::post('/change_game_amount', 'AdminController@change_game_amount')->name('change_game_amount');
Route::post('/change_game_image', 'AdminController@change_game_image')->name('change_game_image');
Route::get('/favorites', 'FavoritesController@favorites')->name('favorites');
Route::post('/add_favorite', 'FavoritesController@add_favorite')->name('add_favorite');
Route::post('/delete_from_favorites', 'FavoritesController@delete_from_favorites')->name('delete_from_favorites');
Route::post('/clear_favorites', 'FavoritesController@clear_favorites')->name('clear_favorites');

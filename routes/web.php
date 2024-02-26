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

Route::get('/adminPanel', 'AdminController@adminPanel')->name('adminPanel');
Route::post('/addProductToCatalog', 'AdminController@addProductToCatalog')->name('addProductToCatalog');
Route::post('/addGenreToCatalog', 'AdminController@addGenreToCatalog')->name('addGenreToCatalog');
Route::post('/addCategoryToCatalog', 'AdminController@addCategoryToCatalog')->name('addCategoryToCatalog');
Route::post('/linkProductGenre', 'AdminController@linkProductGenre')->name('linkProductGenre');



Route::any('/game_page/{game_name}', function ($game_name) {

    $game = DB::table('games')->where('name', $game_name)->get();

    $genres = DB::table('game_genres')->where('game_name', $game_name)->pluck('genre_name');

    $change = Game::find($game[0]->id);
    $change->count++;
    $change->save();

    return view('game_page', [
        'game' => $game[0],
        'genres' => $genres
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

Route::get('/', 'GameController@home')->name('home');
Route::get('/home', 'GameController@home')->name('home');

Route::get('/basket', 'BasketController@basket')->name('basket');
Route::post('/add_game_to_basket', 'BasketController@add_game_to_basket')->name('add_game_to_basket');
Route::post('/clear_basket', 'BasketController@clear_basket')->name('clear_basket');
Route::post('/change_amount_game_to_basket', 'BasketController@change_amount_game_to_basket')->name(
    'change_amount_game_to_basket'
);

Route::get('/favorites', 'FavoritesController@favorites')->name('favorites');
Route::post('/add_favorite', 'FavoritesController@add_favorite')->name('add_favorite');
Route::post('/delete_from_favorites', 'FavoritesController@delete_from_favorites')->name('delete_from_favorites');
Route::post('/clear_favorites', 'FavoritesController@clear_favorites')->name('clear_favorites');





Route::post('/game_platform', 'AdminController@game_platform')->name('game_platform');
Route::post('/change_description', 'AdminController@change_description')->name('change_description');
Route::post('/change_game_amount', 'AdminController@change_game_amount')->name('change_game_amount');
Route::post('/change_game_image', 'AdminController@change_game_image')->name('change_game_image');

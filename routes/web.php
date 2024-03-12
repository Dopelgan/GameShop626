<?php

use App\Metascore;
use App\Product;
use App\ProductGenre;
use App\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
Route::post('/addToBasket', 'BasketController@addToBasket')->name('addToBasket');
Route::post('/addToFavorite', 'FavoriteController@addToFavorite')->name('addToFavorite');
Route::get('/autoAddProductToCatalog', 'AdminController@autoAddProductToCatalog')->name('autoAddProductToCatalog');
Route::post('/filter', 'ProductController@filter')->name('filter');
Route::post('/clearFavorites', 'FavoriteController@clearFavorites')->name('clearFavorites');
Route::post('/deleteFavorite', 'FavoriteController@deleteFavorite')->name('deleteFavorite');

Route::any('/product/{product_id}', function ($product_id) {
    $product = Product::find($product_id);
    $product->count++;
    $product->save();
    return view('product', [
        'product' => Product::where('id', $product_id)->get()->find($product_id),
        'genres' => Genre::whereIn('id', ProductGenre::where('product_id', $product_id)->get()->pluck('genre_id'))->get(),
        'metascore' => Metascore::where('product_id', $product_id)->get()->first(),
        'products' => Product::orderBy('count', 'DESC')->take(6)->get(),
        'metascores' => Metascore::whereIn('product_id', Product::orderBy('count', 'DESC')->take(6)->pluck('id'))->get()
    ]);
})->name('product');

Route::any('/platform/{name}', function ($name) {

    $find_platform = DB::table('platforms')->where('name', $name)->get();
    $games_name = DB::table('game_platforms')->where('platform_name', $name)->pluck('game_name');
    $games = DB::table('games')->whereIn('name', $games_name)->get();

    return view('platform', [
        'platform' => $find_platform[0],
        'games' => $games,
    ]);
});

Route::post('/platform_game', 'ProductController@platform_game')->name('platform_game');

Route::get('/basket', 'BasketController@basket')->name('basket');
Route::post('/clear_basket', 'BasketController@clear_basket')->name('clear_basket');
Route::post('/change_amount_game_to_basket', 'BasketController@change_amount_game_to_basket')->name(
    'change_amount_game_to_basket'
);

Route::get('/favorites', 'FavoriteController@favorites')->name('favorites');








Route::post('/game_platform', 'AdminController@game_platform')->name('game_platform');
Route::post('/change_description', 'AdminController@change_description')->name('change_description');
Route::post('/change_game_amount', 'AdminController@change_game_amount')->name('change_game_amount');
Route::post('/changeProductPicture', 'AdminController@changeProductPicture')->name('changeProductPicture');

Route::get('/', 'HomeController@home')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

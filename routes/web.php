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

Route::get('/', 'HomeController@home')->name('home');
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/product/{id}', 'ProductController@show')->name('product.show');

Route::any('/filter', 'FilterController@filter')->name('filter');

Route::get('/favorites', 'FavoriteController@favorites')->name('favorites');
Route::post('/addToFavorite', 'FavoriteController@addToFavorite')->name('addToFavorite');
Route::post('/clearFavorites', 'FavoriteController@clearFavorites')->name('clearFavorites');
Route::post('/deleteFavorite', 'FavoriteController@deleteFavorite')->name('deleteFavorite');

Route::get('/basket', 'BasketController@basket')->name('basket');
Route::post('/addToBasket', 'BasketController@addToBasket')->name('addToBasket');
Route::post('/clearBasket', 'BasketController@clearBasket')->name('clearBasket');

Route::get('/adminPanel', 'AdminController@adminPanel')->name('adminPanel');
Route::post('/addProduct', 'AdminController@addProduct')->name('addProduct');
Route::get('/autoAddProduct', 'AdminController@autoAddProduct')->name('autoAddProduct');
Route::post('/changeDescription', 'AdminController@changeDescription')->name('changeDescription');
Route::post('/changeQuantity', 'AdminController@changeQuantity')->name('changeQuantity');
Route::post('/changeProductPicture', 'AdminController@changeProductPicture')->name('changeProductPicture');
Route::post('/addGenreToCatalog', 'AdminController@addGenreToCatalog')->name('addGenreToCatalog');
Route::post('/addCategoryToCatalog', 'AdminController@addCategoryToCatalog')->name('addCategoryToCatalog');
Route::post('/linkProductGenre', 'AdminController@linkProductGenre')->name('linkProductGenre');

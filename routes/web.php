<?php

use App\Http\Controllers\BasketController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/home', [HomeController::class, 'home'])->name('home');
Auth::routes();

Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');
Route::resource('products', 'ProductController');

Route::any('/filter', [FilterController::class, 'filter'])->name('filter');

Route::prefix('favorites')->middleware('auth')->group(function () {
    // Получить список избранного
    Route::get('/', [FavoriteController::class, 'index'])->name('favorites.index');

    // Добавить в избранное
    Route::post('/', [FavoriteController::class, 'store'])->name('favorites.store');

    // Удалить из избранного (передаем ID элемента)
    Route::delete('/{id}', [FavoriteController::class, 'destroy'])->name('favorites.destroy');

    // Очистить избранное
    Route::delete('/', [FavoriteController::class, 'clear'])->name('favorites.clear');
});

Route::prefix('basket')->middleware('auth')->group(function () {
    // Просмотр корзины
    Route::get('/', [BasketController::class, 'index'])->name('basket.index');

    // Добавление товара в корзину
    Route::post('/', [BasketController::class, 'store'])->name('basket.store');

    // Удаление товара из корзины (передаем ID товара)
    Route::delete('/{id}', [BasketController::class, 'destroy'])->name('basket.destroy');

    // Очистка корзины
    Route::delete('/', [BasketController::class, 'clear'])->name('basket.clear');
});

Route::any('/order', [PackageController::class, 'order'])->name('order');
Route::post('/makePackage', [PackageController::class, 'makePackage'])->name('makePackage');


Route::prefix('profile')->middleware(['auth'])->group(function () {
    // Роут для отображения профиля пользователя
    Route::get('/', [UserController::class, 'profile'])->name('user.profile');

    // Роут для обновления данных профиля
    Route::put('/update', [UserController::class, 'updateProfile'])->name('user.update');
    Route::put('/editProfile', [UserController::class, 'editProfile'])->name('user.edit');
});

Route::get('/change-password', 'UserController@showChangePasswordForm')->name('password.change');
Route::post('/change-password', 'UserController@changePassword')->name('password.update');


Route::any('/package/{id}', 'PackageController@package')->name('package');
Route::post('/packageRemove', 'PackageController@remove')->name('packageRemove');


Route::get('/adminPanel', 'AdminController@adminPanel')->name('adminPanel');
Route::post('/addProduct', 'AdminController@addProduct')->name('addProduct');
Route::get('/autoAddProduct', 'AdminController@autoAddProduct')->name('autoAddProduct');
Route::post('/changeDescription', 'AdminController@changeDescription')->name('changeDescription');
Route::post('/changeQuantity', 'AdminController@changeQuantity')->name('changeQuantity');
Route::post('/changeProductPicture', 'AdminController@changeProductPicture')->name('changeProductPicture');
Route::post('/addGenre', 'AdminController@addGenre')->name('addGenre');
Route::post('/addCategory', 'AdminController@addCategory')->name('addCategory');
Route::post('/linkProductGenre', 'AdminController@linkProductGenre')->name('linkProductGenre');

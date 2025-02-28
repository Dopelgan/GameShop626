<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Client\ClientProductController;
use App\Http\Controllers\Client\ClientBasketController;
use App\Http\Controllers\Client\ClientFavoriteController;
use App\Http\Controllers\Client\ClientFilterController;
use App\Http\Controllers\Client\ClientPackageController;
use App\Http\Controllers\HomeController;
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

Route::get('/product/{id}', [ClientProductController::class, 'show'])->name('product.show');
Route::get('/product/{id}/get', [ClientProductController::class, 'get'])->name('product.get');

Route::any('/filter', [ClientFilterController::class, 'filter'])->name('filter');

Route::prefix('favorites')->middleware('auth')->group(function () {
    // Получить список избранного
    Route::get('/', [ClientFavoriteController::class, 'index'])->name('favorites.index');

    // Добавить в избранное
    Route::post('/', [ClientFavoriteController::class, 'store'])->name('favorites.store');

    // Удалить из избранного (передаем ID элемента)
    Route::delete('/{id}', [ClientFavoriteController::class, 'destroy'])->name('favorites.destroy');

    // Очистить избранное
    Route::delete('/', [ClientFavoriteController::class, 'clear'])->name('favorites.clear');
});

Route::prefix('basket')->middleware('auth')->group(function () {
    // Просмотр корзины
    Route::get('/', [ClientBasketController::class, 'index'])->name('basket.index');

    // Добавление товара в корзину
    Route::post('/', [ClientBasketController::class, 'store'])->name('basket.store');

    // Удаление товара из корзины (передаем ID товара)
    Route::delete('/{id}', [ClientBasketController::class, 'destroy'])->name('basket.destroy');

    // Очистка корзины
    Route::delete('/', [ClientBasketController::class, 'clear'])->name('basket.clear');
});

Route::prefix('profile')->middleware(['auth'])->group(function () {
    // Роут для отображения профиля пользователя
    Route::get('/', [UserController::class, 'profile'])->name('user.profile');

    // Роут для обновления данных профиля
    Route::put('/update', [UserController::class, 'update'])->name('user.update');
    Route::put('/edit', [UserController::class, 'edit'])->name('user.edit');
});

Route::prefix('admin')->middleware(['auth', 'can:access-admin'])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
});

Route::prefix('products')->middleware(['auth', 'can:access-admin'])->group(function () {
    // Роут для отображения профиля пользователя
    Route::get('/', [AdminProductController::class, 'index'])->name('products.index');

    // Роут для обновления данных профиля
    Route::get('/create', [AdminProductController::class, 'create'])->name('products.create');
    Route::post('/store', [AdminProductController::class, 'store'])->name('products.store');
    Route::put('/update', [AdminProductController::class, 'update'])->name('products.update');
    Route::get('/{id}/edit', [AdminProductController::class, 'edit'])->name('products.edit');
    Route::delete('/destroy/{id}', [AdminProductController::class, 'destroy'])->name('products.destroy');
});

Route::get('/products/new', [ClientProductController::class, 'new']);
Route::get('/products/popular', [ClientProductController::class, 'popular']);

Route::get('/test', function () {
    return view('test'); // Возвращаем представление welcome.blade.php
});






Route::any('/order', [ClientPackageController::class, 'order'])->name('order');
Route::post('/makePackage', [ClientPackageController::class, 'makePackage'])->name('makePackage');

Route::get('/change-password', 'UserController@showChangePasswordForm')->name('password.change');
Route::post('/change-password', 'UserController@changePassword')->name('password.update');

Route::any('/package/{id}', 'ClientPackageController@package')->name('package');
Route::post('/packageRemove', 'ClientPackageController@remove')->name('packageRemove');

Route::post('/addProduct', 'AdminController@addProduct')->name('addProduct');
Route::get('/autoAddProduct', 'AdminController@autoAddProduct')->name('autoAddProduct');
Route::post('/changeDescription', 'AdminController@changeDescription')->name('changeDescription');
Route::post('/changeQuantity', 'AdminController@changeQuantity')->name('changeQuantity');
Route::post('/changeProductPicture', 'AdminController@changeProductPicture')->name('changeProductPicture');
Route::post('/addGenre', 'AdminController@addGenre')->name('addGenre');
Route::post('/addCategory', 'AdminController@addCategory')->name('addCategory');
Route::post('/linkProductGenre', 'AdminController@linkProductGenre')->name('linkProductGenre');

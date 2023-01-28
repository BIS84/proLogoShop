<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

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

Route::get('/', function () {
    return view('index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/order', [OrderController::class, 'index'])->name('home');
});

require __DIR__.'/auth.php';

/*=======================*/

Route::get('logout', [AuthenticatedSessionController::class, 'destroy'])->name('get-logout');

Route::get('/categories', function () {
	return view('categories');
});

Route::get('/mobiles/iphone_x_64', function () {
	return view('product');
});

Route::get('/', [MainController::class, 'index'])->name('index');

Route::get('/basket', [BasketController::class, 'basket'])->name('basket');

Route::get('/basket/place', [BasketController::class, 'basketPlace'])->name('basket-place');

Route::post('/basket/place', [BasketController::class, 'basketConfirm'])->name('basket-confirm');

Route::match(['get', 'post'], 'basket/add/{id}', [BasketController::class, 'basketAdd'])->name('basket-add');

Route::match(['get', 'post'], 'basket/remove/{id}', [BasketController::class, 'basketRemove'])->name('basket-remove');

Route::get('/categories', [MainController::class, 'categories'])->name('categories');

Route::get('/{category}', [MainController::class, 'category'])->name('category');

Route::get('/mobiles/{product?}', [MainController::class, 'product'])->name('product');

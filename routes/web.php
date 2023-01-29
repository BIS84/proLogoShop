<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Person\OrderController as PersonOrderController;
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

    Route::prefix('person')->namespace('Person')->group(function () {
		Route::get('/orders', [PersonOrderController::class, 'index'])->name('orders.index');
		Route::get('/orders/{order}', [PersonOrderController::class, 'show'])->name('person.order.show');
	});

    Route::prefix('admin')->group(function () {
		Route::middleware('is_admin')->namespace('Admin')->group(function () {
			Route::get('/orders', [OrderController::class, 'index'])->name('home');
            Route::get('/orders/{order}', [OrderController::class, 'show'])->name('order.show');
        });
		Route::resource('categories', CategoryController::class);
        Route::resource('products', ProductController::class);
	});
});

require __DIR__.'/auth.php';

/*=======================*/

Route::get('logout', [AuthenticatedSessionController::class, 'destroy'])->name('get-logout');

Route::get('/mobiles/iphone_x_64', function () {
	return view('product');
});

Route::get('/', [MainController::class, 'index'])->name('index');

Route::prefix('basket')->group(function() {

	Route::match(['get', 'post'], '/add/{id}', [BasketController::class, 'basketAdd'])->name('basket-add');

	Route::middleware('basket_not_empty')->group(function () {
		Route::get('/', [BasketController::class, 'basket'])->name('basket');

		Route::get('/place', [BasketController::class, 'basketPlace'])->name('basket-place');

		Route::post('/place', [BasketController::class, 'basketConfirm'])->name('basket-confirm');
	});

	Route::match(['get', 'post'], '/remove/{id}', [BasketController::class, 'basketRemove'])->name('basket-remove');


});

Route::get('/categories', [MainController::class, 'categories'])->name('categories');

Route::get('/{category}', [MainController::class, 'category'])->name('category');

Route::get('/mobiles/{product?}', [MainController::class, 'product'])->name('product');

Route::get('/reset', [ResetController::class, 'reset'])->name('reset');

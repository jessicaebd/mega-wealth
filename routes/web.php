<?php

use App\Models\Office;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\UserController;

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

Route::controller(PageController::class)
    ->group(function () {
        Route::get('/', 'index')->name('home');
        Route::get('/home/properties', 'search')->name('search');

        Route::middleware('NotAdminMiddleware')->group(function () {
            Route::get('/home/buy', 'buy')->name('buy');
            Route::get('/home/rent', 'rent')->name('rent');
            Route::get('/home/about', 'about')->name('about_us');
        });
    });

Route::group(['prefix' => 'auth'], function () {
    Route::middleware('GuestMiddleware')->group(function () {
        Route::get('login', [LoginController::class, 'index'])->name('login_page');
        Route::post('login', [LoginController::class, 'login'])->name('login');
        Route::get('register', [RegisterController::class, 'index'])->name('register_page');
        Route::post('register', [RegisterController::class, 'register'])->name('register');
    });
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
});

// area khusus member
Route::prefix('cart/')
    ->controller(UserController::class)
    ->middleware('MemberMiddleware')
    ->group(function () {
        Route::get('/history', 'showTransactionHistory')->name('show_transaction_history');

        Route::get('/', 'cartIndex')->name('show_cart');
        Route::post('/insert', 'cartInsert')->name('insert_cart_item');
        Route::post('/discard', 'cartDiscard')->name('discard_cart_item');
        Route::post('/checkout/{property}', 'cartCheckout')->name('checkout_cart_item');
    });

Route::prefix('admin/office')
    ->controller(OfficeController::class)
    ->middleware('AdminMiddleware')
    ->group(function () {

        Route::get('/', 'index')->name('manage_office');
        Route::get('/add', 'create')->name('add_office');
        Route::post('/add', 'store')->name('store_office');
        Route::get('/edit/{office}', 'edit')->name('update_office_form');
        Route::put('/edit', 'update')->name('update_office');
        Route::delete('/delete/{office}', 'destroy')->name('delete_office');
    });

Route::prefix('admin/property')
    ->controller(PropertyController::class)
    ->middleware('AdminMiddleware')
    ->group(function () {

        Route::get('/', 'index')->name('manage_property');
        Route::get('/add', 'create')->name('add_property');
        Route::post('/add', 'store')->name('store_property');
        Route::get('/edit/{property}', 'edit')->name('update_property_form');
        Route::put('/edit', 'update')->name('update_property');
        Route::post('/up-for-rent', 'upForRent')->name('up_for_rent');
        Route::delete('/delete/{property}', 'destroy')->name('delete_property');
        Route::post('/finish', 'finish')->name('finish_property');
    });

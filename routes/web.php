<?php

use App\Models\Office;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

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
    return view('home');
})->name('home');

Route::group(['prefix' => 'auth'], function () {
    Route::get('login', [LoginController::class, 'index'])->name('login_page');
    Route::get('register', [RegisterController::class, 'index'])->name('register_page');
    Route::post('login', [LoginController::class, 'login'])->name('login');
    Route::post('register', [RegisterController::class, 'register'])->name('register');
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
});

Route::get('/login', function () {
    return 'Login Page';
})->name('login');

Route::prefix('admin/office')
    ->controller(OfficeController::class)
    // ->middleware('AdminMiddleware')
    ->group(function () {

        Route::get('/', 'index')->name('manage-office');
        Route::get('/add', 'create')->name('add-office');
        Route::post('/add', 'store')->name('store-office');
        Route::get('/edit/{office}', 'edit')->name('update-office-form');
        Route::put('/edit', 'update')->name('update-office');
        Route::delete('/delete/{office}', 'destroy')->name('delete-office');

    });

Route::get('/about', [OfficeController::class, 'about'])->name('about-us');

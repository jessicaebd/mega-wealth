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
    // Route::get('logout', [\App\Http\Controllers\UserController::class, 'logout'])->name('logout');
});

Route::get('/about', function () {
    return view('about.index', [
        'offices' => Office::all(),
    ]);
})->name('about-us');

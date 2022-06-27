<?php

use App\Http\Controllers\OfficeController;
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

Route::get('/', function () {
    return view('home');
});

Route::get('/login', function() {
    return 'Login Page';
})->name('login');

Route::prefix('admin/office')
    ->controller(OfficeController::class)
    // ->middleware('AdminMiddleware')
    ->group(function() {
        
        Route::get('/', 'index')->name('manage-office');
        Route::get('/add', 'create')->name('add-office');
        Route::post('/add', 'store')->name('store-office');
        Route::get('/edit/{office}', 'edit')->name('update-office-form');
        Route::put('/edit', 'update')->name('update-office');
        Route::delete('/delete/{office}', 'destroy')->name('delete-office');

    });
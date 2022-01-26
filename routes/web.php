<?php

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/cal1', [App\Http\Controllers\CalController::class, 'index'])->name('home');
Route::get('/cal2', [App\Http\Controllers\CalController::class, 'cal'])->name('home');
Route::get('/get-date/{year}/{month}', [App\Http\Controllers\CalController::class, 'get_date'])->name('get_date');
Route::get('/check-conectivity', [App\Http\Controllers\CalController::class, 'check_conectivity'])->name('check_conectivity');

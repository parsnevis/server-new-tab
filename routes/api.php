<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});


Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function() {

    Route::get('/me', function(Request $request) { return auth()->user(); });

    Route::post('/auth/logout', [AuthController::class, 'logout']);



    Route::get('/get-phonebook', [CalController::class, 'get_phonebook'])->name('get_phonebook');


//    Route::get('/list-region', [CalController::class, 'list_region'])->name('list_region');
//    Route::get('/tel-number', [CalController::class, 'tel_number'])->name('tel_number');
});


Route::group(['middleware' => ['cors']], function() {

//    Route::get('/get-time', [CalController::class, 'get_time'])->name('get_timey');

    Route::get('/get-today', [CalController::class, 'get_today'])->name('get_today');


    Route::get('/get-calendar-dates', [CalController::class, 'get_calendar_dates'])->name('get_calendar_dates');

    Route::get('/get-date/{year?}/{month?}', [CalController::class, 'get_date'])->name('get_date');

    Route::post('/user/login/national-id', [CalController::class, 'user_login_national_id'])->name('user_login_national_id');

    Route::post('/get-weather', [CalController::class, 'get_weather'])->name('get_weather');
});





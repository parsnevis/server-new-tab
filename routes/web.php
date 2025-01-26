<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CalController;


//use App\Http\Controllers\Admin\Auth\RegisterController;
//use App\Http\Controllers\Admin\Auth\LoginController;
//use App\Http\Controllers\Admin\Auth\ForgotPasswordController;
//use App\Http\Controllers\Admin\Auth\ResetPasswordController;
////use App\Http\Controllers\Admin\Auth\ResetPasswordController;
//
////use App\Http\Controllers\Admin\BackController;
//use App\Http\Controllers\Admin\UploadController;
//use App\Http\Controllers\Admin\AjaxController;
//use App\Http\Controllers\Admin\RoleController;
//use App\Http\Controllers\Admin\PermissionController;

//use App\Http\Controllers\Reseller\Auth;


//use App\Http\Controllers\Reseller\Auth\RegisterController;
//use App\Http\Controllers\Reseller\Auth\LoginController;
//use App\Http\Controllers\Reseller\Auth\ForgotPasswordController;
//use App\Http\Controllers\Reseller\Auth\ResetPasswordController;
////use App\Http\Controllers\Admin\Auth\ResetPasswordController;
///

use App\Http\Controllers\Reseller\Auth\RegisterController;
use App\Http\Controllers\Reseller\Auth\LoginController;
use App\Http\Controllers\Reseller\Auth\ForgotPasswordController;
use App\Http\Controllers\Reseller\Auth\ResetPasswordController;
use App\Http\Controllers\Reseller\ResellerController;
use App\Http\Controllers\Reseller\UserController;
use Illuminate\Support\Facades\Artisan;

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

Route::get('/clear_cache', function() {
    // $exitCode = Artisan::call('cache:clear');
    // $exitCode = Artisan::call('config:cache');
    
   
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('view:clear');
    $exitCode = Artisan::call('route:clear');
    
    $exitCode = Artisan::call('route:cache');
    $exitCode = Artisan::call('config:cache');


   return "Cache cleared successfully";
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/cal1', [CalController::class, 'index'])->name('home1');
Route::get('/cal2', [CalController::class, 'cal'])->name('home2');

Route::get('/check-conectivity', [CalController::class, 'check_conectivity'])->name('check_conectivity');
Route::get('/create-calendar/{year}', [CalController::class, 'create_calendar'])->name('create_calendar');
Route::post('/ceartor', [CalController::class, 'ceartor'])->name('ceartor');

Route::get('/terms', [HomeController::class, 'terms'])->name('terms');
Route::get('/landing', [HomeController::class, 'landing'])->name('landing');


Route::get('/register/from/app/create', [HomeController::class, 'register_from_app_create'])->name('register_from_app_create');
Route::post('/register/reseller/from/app/store', [RegisterController::class, 'register'])->name('register_reseller_from_app_store');
Route::post('/register/user/from/app/store', [HomeController::class, 'register_user_from_app_store'])->name('register_user_from_app_store');

// Route::get('/user', function (Request $request) {
//     return $request->user();
// });


/*
|------------------
| Admin Route
| All the admin routes will be defined here...
|------------------
*/
//Route::prefix('/admin')->name('admin.')->group(function(){
//
//    Route::get('/', function () {return redirect('admin/login');})->name('admin');
//
//    Route::namespace('Auth')->group(function(){
//        //Register Routes
//        Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
//        Route::post('/register', [RegisterController::class, 'register']);
//
//        //Login Routes
//        Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
//        Route::post('/login', [LoginController::class, 'login']);
//        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
//
//        //Forgot Password Routes
//        Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
//        Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
//
//        //Reset Password Routes
//        Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
//        Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
//    });
//
//
//    Route::group(['middleware' => ['role_or_permission:Super User|Management|Administrator|', 'SetLang']],
//        function () {
//
////            Route::get('console', [BackController::class, 'index'])->name('console');
////
////            Route::get('shipments', [ShipmentController::class, 'index'])->name('shipments.index');
////            Route::get('shipments/create', [ShipmentController::class, 'create'])->name('shipments.create');
////            Route::post('shipments', [ShipmentController::class, 'store'])->name('shipments.store');
////            Route::get('shipments/{shipment}', [ShipmentController::class, 'show'])->name('shipments.show');
////            Route::get('shipments/{shipment}/edit', [ShipmentController::class, 'edit'])->name('shipments.edit');
////            Route::put('shipments/{shipment}', [ShipmentController::class, 'update'])->name('shipments.update');
////            Route::delete('shipments/{shipment}', [ShipmentController::class, 'destroy'])->name('shipments.destroy');
//
//
//            Route::get('load_permissions', [AjaxController::class, 'loadPermissions'])->name('load_permissions');
//            Route::resource('roles',RoleController::class);
//            Route::resource('permissions',PermissionController::class);
//
//            Route::post('upload', [UploadController::class, 'upload'])->name('upload');
////
////            Route::get('profile', [BackController::class, 'profile'])->name('profile');
////            Route::post('profile_update', [BackController::class, 'profileUpdate'])->name('profile_update');
//
//        });
//
//});
//



/*
|------------------
| Reseller Route
| All the reseller routes will be defined here...
|------------------
*/
Route::prefix('/reseller')->name('reseller.')->group(function(){

    Route::get('/', function () {return redirect('reseller/login');})->name('reseller');

    Route::namespace('Auth')->group(function(){
        //Register Routes
        Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
        Route::post('/register', [RegisterController::class, 'register']);

        //Login Routes
        Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [LoginController::class, 'login']);
        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

        //Forgot Password Routes
        Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
        Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

        //Reset Password Routes
        Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
        Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
    });

    Route::resource('users',UserController::class);


//    Route::group(['middleware' => ['role_or_permission:Super User|Management|Administrator|', 'SetLang']],
    Route::namespace('reseller')->middleware(['activate'])->group(function () {

            Route::get('dashboard', [ResellerController::class, 'index'])->name('dashboard');
            Route::get('profile', [ResellerController::class, 'profile'])->name('profile');

//
//            Route::get('shipments', [ShipmentController::class, 'index'])->name('shipments.index');
//            Route::get('shipments/create', [ShipmentController::class, 'create'])->name('shipments.create');
//            Route::post('shipments', [ShipmentController::class, 'store'])->name('shipments.store');
//            Route::get('shipments/{shipment}', [ShipmentController::class, 'show'])->name('shipments.show');
//            Route::get('shipments/{shipment}/edit', [ShipmentController::class, 'edit'])->name('shipments.edit');
//            Route::put('shipments/{shipment}', [ShipmentController::class, 'update'])->name('shipments.update');
//            Route::delete('shipments/{shipment}', [ShipmentController::class, 'destroy'])->name('shipments.destroy');


            Route::get('load_permissions', [AjaxController::class, 'loadPermissions'])->name('load_permissions');
            Route::resource('roles',RoleController::class);
            Route::resource('permissions',PermissionController::class);


            Route::post('upload', [UploadController::class, 'upload'])->name('upload');
//
//            Route::get('profile', [BackController::class, 'profile'])->name('profile');
//            Route::post('profile_update', [BackController::class, 'profileUpdate'])->name('profile_update');

        });

});



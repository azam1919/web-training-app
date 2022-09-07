<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WebTrainingController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

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
    if (Session::has('r_id') && Session::get('status') == 1) {
        return redirect('admin/dashboard');
    } else {
        return view('home.index');
    }
});
Route::post('/logout', [LogoutController::class, 'logout']);

Route::prefix('admin')->group(function () {
    Route::match(['get', 'post'], '/', [LoginController::class, 'admin_login']);

    // Route::middleware('AdminLogin')->group(function () {
    //For Login
    Route::prefix('auth')->group(function () {
        Route::view('/forget', 'user.auth.forget');
        Route::view('/reset', 'user.auth.reset');
        Route::post('/forget', [ForgotPasswordController::class, 'user_forget_password']);
        Route::post('/reset', [ResetPasswordController::class, 'user_reset_password']);
    });
    //DashboardController
    Route::prefix('dashboard')->group(function () {
        Route::get('/', [DashboardController::class, 'admin_dashboard']);
    });
    Route::prefix('web-training')->group(function () {
        Route::get('/', [WebTrainingController::class, 'index']);
        Route::match(['get', 'post'], '/create', [WebTrainingController::class, 'store']);
    });
    // });
});

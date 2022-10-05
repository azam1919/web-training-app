<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\WebTraining\heading\WebTrainingController as HeadingWebTrainingController;
use App\Http\Controllers\WebTraining\tutorial\WebTrainingController;
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
        Route::get('/', [DashboardController::class, 'admin_dashboard'])->name('dashboard.index');
    });
    Route::prefix('web-training')->group(function () {
        Route::get('/', [HeadingWebTrainingController::class, 'index'])->name('web_training.index');
        Route::prefix('heading')->group(function () {
            Route::get('/create', [HeadingWebTrainingController::class, 'show'])->name('heading.create.show');
            Route::post('/create', [HeadingWebTrainingController::class, 'store'])->name('heading.create.store');
            // Route::get('/edit/{id}', [HeadingWebTrainingController::class, 'edit'])->name('heading.edit.show');
            Route::post('/edit', [HeadingWebTrainingController::class, 'update'])->name('heading.edit.update');
            Route::post('/delete', [HeadingWebTrainingController::class, 'delete'])->name('heading.delete');
        });
        Route::prefix('tutorial')->group(function () {
            Route::get('/create', [WebTrainingController::class, 'show'])->name('tutorial.create.show');
            Route::post('/create', [WebTrainingController::class, 'store'])->name('tutorial.create.store');
            Route::get('/edit/{id}', [WebTrainingController::class, 'edit'])->name('tutorial.edit.show');
            Route::post('/edit', [WebTrainingController::class, 'update'])->name('tutorial.edit.update');
        });
    });
    Route::match(['get', 'post'], '/test', [WebTrainingController::class, 'storing']);


    // });
});

Route::resource('image', ImageController::class);

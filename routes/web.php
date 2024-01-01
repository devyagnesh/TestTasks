<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/**
 * redirecting to /login to quick test app
 */
Route::middleware(['guest'])->group(function(){
    Route::get('/',function(){
        return redirect('/login');
    });
    Route::get('/login', [AuthController::class,'viewLogin'])->name('viewLogin');
    Route::post('/login',[AuthController::class,'postLogin'])->name('postLogin');
    Route::get('/signup',[AuthController::class,'viewSignup'])->name('viewSignup');
    Route::post('/signup',[AuthController::class,'postSignup'])->name('postSignup');
});

Route::middleware(['auth'])->group(function(){
    Route::get('/dashboard',[DashboardController::class,'viewDashboard'])->name('viewDashboard');
    Route::post('/logout',[DashboardController::class,'postLogout'])->name('postLogout');

    Route::middleware(['isAdmin'])->group(function(){
        Route::get('/delete/{id}',[DashboardController::class,'deleteUser'])->name('deleteUser');
        Route::get('/update/{id}',[DashboardController::class,'viewUpdateProfile'])->name('viewUpdateProfile');
        Route::post('/update',[DashboardController::class,'postUpdateProfile'])->name('postUpdateProfile');
    });
});
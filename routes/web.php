<?php

use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\OffersController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function(){
    Route::namespace('Auth')->middleware('guest:admin')->group(function(){
        Route::get('login',[AuthenticatedSessionController::class, 'create'])->name('login');
        Route::post('login',[AuthenticatedSessionController::class, 'store'])->name('adminlogin');
    });
    Route::middleware('admin')->group(function(){
        Route::get('dashboard', [HomeController::class, 'index'])->name('dashboard');
        Route::get('export', [OffersController::class, 'export'])->name('export');
        Route::post('list-offers', [OffersController::class, 'listOffers'])->name('list-offers');
    });
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

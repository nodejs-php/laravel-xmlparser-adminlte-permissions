<?php

use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\OffersController;
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
        Route::get('dashboard', [OffersController::class, 'index'])->name('dashboard');
        Route::get('import-page', [OffersController::class, 'importPage'])->name('import-page');
        Route::get('download-page', [OffersController::class, 'downloadPage'])->name('download-page');
        Route::post('list-offers', [OffersController::class, 'listOffers'])->name('list-offers');
        Route::get('download-products', [OffersController::class, 'downloadProducts'])->name('download-products');
        Route::post('import-products', [OffersController::class, 'loadAndParseProduct'])->name('import-products');
    });
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

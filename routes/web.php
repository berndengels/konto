<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KontoController;

Auth::routes();
Route::get('', [HomeController::class, 'index'])->name('home');

Route::group([
    'prefix'  => 'konto',
    'middleware' => 'auth',
], function() {
    Route::get('create', [KontoController::class, 'create'])->name('konto.create');
    Route::post('store', [KontoController::class, 'store'])->name('konto.store');
    Route::get('{konto}', [KontoController::class, 'show'])->name('konto.show');
    Route::match(['get','post'],'', [KontoController::class, 'index'])->name('konto');
});

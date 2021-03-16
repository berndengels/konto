<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KontoController;

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

Auth::routes();

Route::get('', [HomeController::class, 'index'])->name('home');
Route::group([
    'prefix'  => 'konto',
], function() {
//    Route::get('', [KontoController::class, 'index'])->name('konto');
//    Route::post('filter', [KontoController::class, 'filter'])->name('konto.filter');
    Route::get('create', [KontoController::class, 'create'])->name('konto.create');
    Route::post('store', [KontoController::class, 'store'])->name('konto.store');
    Route::get('{konto}', [KontoController::class, 'show'])->name('konto.show');
    Route::match(['get','post'],'', [KontoController::class, 'index'])->name('konto');
});

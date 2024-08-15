<?php

use Illuminate\Support\Facades\Route;
use Modules\Pelanggan\Http\Controllers\ApiPelangganController;

/*
 *--------------------------------------------------------------------------
 * API Routes
 *--------------------------------------------------------------------------
 *
 * Here is where you can register API routes for your application. These
 * routes are loaded by the RouteServiceProvider within a group which
 * is assigned the "api" middleware group. Enjoy building your API!
 *
*/

Route::group(['prefix' => 'pelanggan', 'as' => 'pelanggan.', 'middleware' => [ 'web_and_api' ], 'middleware' => ['web_and_api']], function () {
    Route::get('/', [ApiPelangganController::class, 'index'])->name('index');
    Route::post('/', [ApiPelangganController::class, 'store'])->name('store');
    Route::get('/{id}', [ApiPelangganController::class, 'show'])->name('show');
    Route::put('/{id}', [ApiPelangganController::class, 'update'])->name('update');
    Route::delete('/{id}', [ApiPelangganController::class, 'destroy'])->name('destroy');
});

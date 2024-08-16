<?php

use Illuminate\Support\Facades\Route;
use Modules\Items\Http\Controllers\ApiItemsController;

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

Route::group(['prefix' => 'items', 'as' => 'pelanggan.', 'middleware' => [ 'web_and_api' ], 'middleware' => ['web_and_api']], function () {
    Route::get('/', [ApiItemsController::class, 'index'])->name('index');
    Route::post('/', [ApiItemsController::class, 'store'])->name('store');
    Route::get('/{id}', [ApiItemsController::class, 'show'])->name('show');
    Route::put('/{id}', [ApiItemsController::class, 'update'])->name('update');
    Route::delete('/{id}', [ApiItemsController::class, 'destroy'])->name('destroy');
});

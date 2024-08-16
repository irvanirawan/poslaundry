<?php

use Illuminate\Support\Facades\Route;
use Modules\Category\Http\Controllers\ApiCategoryController;

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

Route::group(['prefix' => 'category', 'as' => 'pelanggan.', 'middleware' => [ 'web_and_api' ], 'middleware' => ['web_and_api']], function () {
    Route::get('/', [ApiCategoryController::class, 'index'])->name('index');
    Route::post('/', [ApiCategoryController::class, 'store'])->name('store');
    Route::get('/{id}', [ApiCategoryController::class, 'show'])->name('show');
    Route::put('/{id}', [ApiCategoryController::class, 'update'])->name('update');
    Route::delete('/{id}', [ApiCategoryController::class, 'destroy'])->name('destroy');
});

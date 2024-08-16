<?php

use Illuminate\Support\Facades\Route;
use Modules\SetupApp\Http\Controllers\ApiSetupAppController;

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

Route::group(['prefix' => 'setupapp', 'as' => 'pelanggan.', 'middleware' => [ 'web_and_api' ], 'middleware' => ['web_and_api']], function () {
    Route::get('/', [ApiSetupAppController::class, 'index']);
    Route::put('/', [ApiSetupAppController::class, 'update']);
});

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::middleware('response-type')->group(function () {
    Route::get('/initialize', [\App\Http\Controllers\Controller::class, 'initialize']);
    Route::get('/currencies', [\App\Http\Controllers\Controller::class, 'getCurrencies']);
});

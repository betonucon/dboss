<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authapi\LoginapiController;
use App\Http\Controllers\Authapi\AbsController;
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
Route::post('login',[LoginapiController::class, 'login']);


Route::middleware('jwt.verify')->group(function () {
    Route::get('user',[LoginapiController::class, 'getAuthenticatedUser']);
    Route::post('/absen',[AbsController::class, 'proses_absen']);
});

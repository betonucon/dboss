<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\VaksinController;
use App\Http\Controllers\CovidController;
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


Route::get('a/{personnel_no}/', 'Auth\LoginController@programaticallyEmployeeLogin')->name('login.a');
Auth::routes();
Route::group(['middleware'    => 'auth'],function(){
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/', 'HomeController@index')->name('home');

});
Route::get('get_vendor',[MasterController::class, 'get_vendor']);
Route::group(['middleware'    => 'auth'],function(){
    Route::get('Vendor',[VendorController::class, 'index']);

});

Route::group(['middleware'    => 'auth'],function(){
    Route::get('Karyawan',[KaryawanController::class, 'index']);
    Route::get('VerifikasiKaryawan',[KaryawanController::class, 'index']);
    Route::get('ListKaryawan',[KaryawanController::class, 'index_admin']);
    Route::get('Karyawan/ubah',[KaryawanController::class, 'ubah']);
    Route::get('Karyawan/cek_qrcode',[KaryawanController::class, 'cek_qrcode']);
    Route::get('Karyawan/KTP',[KaryawanController::class, 'cek_ktp']);
    Route::post('Karyawan',[KaryawanController::class, 'save']);
    Route::post('Karyawan/update',[KaryawanController::class, 'update']);
    Route::post('Karyawan/verifikasi',[KaryawanController::class, 'verifikasi']);

});

Route::group(['middleware'    => 'auth'],function(){
    Route::get('Vaksin',[VaksinController::class, 'index']);
    Route::post('Vaksin',[VaksinController::class, 'save']);
    Route::post('Vaksin/reset',[VaksinController::class, 'reset']);

});

Route::group(['middleware'    => 'auth'],function(){
    Route::get('Covid',[CovidController::class, 'index']);
    Route::post('Covid',[CovidController::class, 'save']);
    Route::post('Covid/reset',[CovidController::class, 'reset']);

});

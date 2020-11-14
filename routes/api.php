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


Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
   

Route::post('login', [App\Http\Controllers\JwtAuthController::class, 'login'])->name('login');
Route::post('register', [App\Http\Controllers\JwtAuthController::class, 'register'])->name('register');
 Route::get('bots', [App\Http\Controllers\ApiBotsController::class, 'index'])->name('bots');
  Route::get('show/{$id}', [App\Http\Controllers\ApiBotsController::class, 'show'])->name('show');
 Route::post('store', [App\Http\Controllers\ApiBotsController::class, 'store'])->name('store');
 Route::post('update', [App\Http\Controllers\ApiBotsController::class, 'update'])->name('update');
 Route::delete('destroy/{id}', [App\Http\Controllers\ApiBotsController::class, 'destroy'])->name('destroy');

});



Route::group(['middleware' => 'auth.jwt'], function () {
Route::post('logout', [App\Http\Controllers\JwtAuthController::class, 'logout'])->name('logout');
   
});



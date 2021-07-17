<?php

use App\Http\Controllers\authcontroller;
use App\Http\Controllers\petanicontroller;
use App\Http\Controllers\usercontroller;
use Illuminate\Support\Facades\Route;

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

// routing authenticate
Route::prefix('auth')->group(function () {
    Route::post('login', [authcontroller::class, 'index']);
    Route::get('logout', [authcontroller::class, 'logout']);
    Route::post('register', [authcontroller::class, 'register']);
});
// routing master user
Route::prefix('user')->group(function () {
    // default routing
    Route::get('/', [usercontroller::class, 'index']);
    Route::post('/', [usercontroller::class, 'add']);
    Route::put('/{id}', [usercontroller::class, 'update']);
    Route::get('/{id}', [usercontroller::class, 'delete']);
    // json handler
    Route::prefix('json')->group(function () {
        Route::get('/{id}', [usercontroller::class, 'getUpdate']);
    });
});
// routing master petani
Route::prefix('petani')->group(function () {
    // default routing
    Route::get('/', [petanicontroller::class, 'index']);
    Route::post('/', [petanicontroller::class, 'add']);
    Route::put('/{id}', [petanicontroller::class, 'update']);
    Route::get('/{id}', [petanicontroller::class, 'delete']);
    // json handler
    Route::prefix('json')->group(function () {
        Route::get('/{id}', [petanicontroller::class, 'getUpdate']);
    });
});

Route::get('/', function () {
    return view('login');
});

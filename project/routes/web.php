<?php

use App\Http\Controllers\authcontroller;
use App\Http\Controllers\entrycontroller;
use App\Http\Controllers\pabrikcontroller;
use App\Http\Controllers\petanicontroller;
use App\Http\Controllers\redirectcontroller;
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
    Route::post('login', [authcontroller::class, 'login'])->name('login');
    Route::get('logout', [authcontroller::class, 'logout']);
    Route::post('register', [authcontroller::class, 'register']);
});
// routing master user
Route::prefix('user')->group(function () {
    // default routing
    Route::get('/', [usercontroller::class, 'indexMethod'])->middleware('authuser');
    Route::put('/{id}', [usercontroller::class, 'updateMethod'])->middleware('authuser');
    Route::get('/{id}', [usercontroller::class, 'deleteMethod'])->middleware('authuser');
    // json handler
    Route::prefix('json')->group(function () {
        Route::get('/{id}', [usercontroller::class, 'getupMethod']);
        Route::get('/search/{s}', [usercontroller::class, 'searchMethod'])->middleware('authuser');
    });
});
// routing master petani
Route::prefix('petani')->group(function () {
    // default routing
    Route::get('/', [petanicontroller::class, 'indexMethod'])->middleware('authuser');
    Route::post('/', [petanicontroller::class, 'addMethod'])->middleware('authuser');
    Route::put('/{id}', [petanicontroller::class, 'updateMethod'])->middleware('authuser');
    Route::get('/{id}', [petanicontroller::class, 'deleteMethod'])->middleware('authuser');
    // json handler
    Route::prefix('json')->group(function () {
        Route::get('/{id}', [petanicontroller::class, 'getupMethod'])->middleware('authuser');
        Route::get('/search/{s}', [petanicontroller::class, 'searchMethod'])->middleware('authuser');
    });
});
// routing master pabrik
Route::prefix('pabrik')->group(function () {
    // default routing
    Route::get('/', [pabrikcontroller::class, 'indexMethod'])->middleware('authuser');
    Route::post('/', [pabrikcontroller::class, 'addMethod'])->middleware('authuser');
    Route::put('/{id}', [pabrikcontroller::class, 'updateMethod'])->middleware('authuser');
    Route::get('/{id}', [pabrikcontroller::class, 'deleteMethod'])->middleware('authuser');
    // json handler
    Route::prefix('json')->group(function () {
        Route::get('/{id}', [pabrikcontroller::class, 'getupMethod'])->middleware('authuser');
        Route::get('/search/{s}', [pabrikcontroller::class, 'searchMethod'])->middleware('authuser');
    });
});
// routing master transaction
Route::prefix('entry')->group(function () {
    // default routing
    Route::get('/', [entrycontroller::class, 'indexMethod']);
    Route::post('/', [entrycontroller::class, 'addMethod']);
    Route::put('/{id}', [entrycontroller::class, 'updateMethod']);
    Route::get('/{id}', [entrycontroller::class, 'deleteMethod']);
    // json handler
    Route::prefix('json')->group(function () {
        Route::get('/{id}', [entrycontroller::class, 'getupMethod'])->middleware('authuser');
        Route::get('/search/{s}', [entrycontroller::class, 'searchMethod'])->middleware('authuser');
    });
});

// routing master laporan
Route::prefix('laporan')->group(function () {
    // default routing
    Route::get('/', function () {
        return view('laporan');
    });
    Route::post('/', [entrycontroller::class, 'addMethod']);
    Route::put('/{id}', [entrycontroller::class, 'updateMethod']);
    Route::get('/{id}', [entrycontroller::class, 'deleteMethod']);
    // json handler
    Route::prefix('json')->group(function () {
        Route::get('/{id}', [pabrikcontroller::class, 'getupMethod'])->middleware('authuser');
    });
});

Route::get('/', [redirectcontroller::class, 'indexMethod']);
Route::get('dashboard', [redirectcontroller::class, 'dashMethod']);

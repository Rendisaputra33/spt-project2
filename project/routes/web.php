<?php

use App\Http\Controllers\authcontroller;
use App\Http\Controllers\dashboardcontroller;
use App\Http\Controllers\entrycontroller;
use App\Http\Controllers\hppcontroller;
use App\Http\Controllers\laporancontroller;
use App\Http\Controllers\pabrikcontroller;
use App\Http\Controllers\pembayarancontroller;
use App\Http\Controllers\pengirimcontroller;
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
Route::middleware('authuser')->prefix('user')
    ->group(function () {
        // default routing
        Route::get('/', [usercontroller::class, 'indexMethod']);
        Route::put('/{id}', [usercontroller::class, 'updateMethod']);
        Route::get('/{id}', [usercontroller::class, 'deleteMethod']);
        // json handler
        Route::prefix('json')->group(function () {
            Route::get('/{id}', [usercontroller::class, 'getupMethod']);
            Route::get('/search/{s}', [usercontroller::class, 'searchMethod']);
        });
    });
// routing master petani
Route::middleware('authuser')->prefix('petani')
    ->group(function () {
        // default routing
        Route::get('/', [petanicontroller::class, 'indexMethod']);
        Route::post('/', [petanicontroller::class, 'addMethod']);
        Route::put('/{id}', [petanicontroller::class, 'updateMethod']);
        Route::get('/{id}', [petanicontroller::class, 'deleteMethod']);
        Route::get('/pabrik/{id}', [petanicontroller::class, 'findMethod']);
        // json handler
        Route::prefix('json')->group(function () {
            Route::get('/{id}', [petanicontroller::class, 'getupMethod']);
            Route::get('/search/{s}', [petanicontroller::class, 'searchMethod']);
        });
    });
// routing master pabrik
Route::middleware('authuser')->prefix('pabrik')
    ->group(function () {
        // default routing
        Route::get('/', [pabrikcontroller::class, 'indexMethod']);
        Route::post('/', [pabrikcontroller::class, 'addMethod']);
        Route::put('/{id}', [pabrikcontroller::class, 'updateMethod']);
        Route::get('/{id}', [pabrikcontroller::class, 'deleteMethod']);
        // json handler
        Route::prefix('json')->group(function () {
            Route::get('/{id}', [pabrikcontroller::class, 'getupMethod']);
            Route::get('/search/{s}', [pabrikcontroller::class, 'searchMethod']);
        });
    });
// routing master transaction
Route::middleware('authuser')->prefix('entry')
    ->group(function () {
        // default routing
        Route::get('/', [entrycontroller::class, 'indexMethod']);
        Route::post('/', [entrycontroller::class, 'addMethod']);
        Route::put('/{id}', [entrycontroller::class, 'updateMethod']);
        Route::get('/{id}', [entrycontroller::class, 'deleteMethod']);
        // json handler
        Route::prefix('json')->group(function () {
            Route::get('/{id}', [entrycontroller::class, 'getupMethod']);
            Route::get('/search/{s}', [entrycontroller::class, 'searchMethod']);
            Route::get('/filter/{tgl}', [entrycontroller::class, 'filterMethod']);
        });

        Route::prefix('cek/hpp')->group(function () {
            Route::get('/',  [hppcontroller::class, 'index']);
            Route::get('/{id}', [hppcontroller::class, 'show']);
            Route::post('/', [hppcontroller::class, 'store']);
        });
    });

// routing master laporan
Route::middleware('authuser')->prefix('laporan')
    ->group(function () {
        // default routing
        Route::get('/', [laporancontroller::class, 'indexMethod']);
        Route::post('/', [laporancontroller::class, 'addMethod']);
        Route::get('/cetak/{f}', [laporancontroller::class, 'filterMethod']);
        // json handler
        Route::prefix('json')->group(function () {
            Route::get('/{id}', [pabrikcontroller::class, 'getupMethod']);
        });
    });

Route::get('/', [redirectcontroller::class, 'indexMethod']);

Route::middleware('authuser')->prefix('dashboard')
    ->group(function () {
        // default routing
        Route::get('/', [dashboardcontroller::class, 'indexMethod']);
        // json handler
        Route::prefix('json')->group(function () {
            Route::get('/{id}', [pabrikcontroller::class, 'getupMethod']);
        });
    });

Route::middleware('authuser')->prefix('pengirim')
    ->group(function () {
        Route::get('/', [pengirimcontroller::class, 'index']);
        Route::post('/', [pengirimcontroller::class, 'add']);
        Route::post('/{id}', [pengirimcontroller::class, 'update']);
        Route::get('/{id}', [pengirimcontroller::class, 'delete']);
        Route::get('/json/{id}', [pengirimcontroller::class, 'getupdate']);
    });

Route::middleware('authuser')->prefix('pembayaran')
    ->group(function () {
        // default
        Route::get('/', [pembayarancontroller::class, 'index']);
        Route::get('/{id}', [pembayarancontroller::class, 'destroy']);
        Route::post('/', [pembayarancontroller::class, 'store'])->name('bayar');
        Route::post('/{id}', [pembayarancontroller::class, 'edit']);
        // transaksi
        Route::prefix('/transaksi')->group(function () {
            Route::get('/list-bayar', [pembayarancontroller::class, 'show']);
            Route::get('/cek-harga', [pembayarancontroller::class, 'cekHarga']);
            Route::post('/filter', [pembayarancontroller::class, 'filter']);
            Route::get('/report', [pembayarancontroller::class, 'report']);
            Route::post('/filter/pembayaran', [pembayarancontroller::class, 'filterTanggal']);
            Route::post('/filter/cek', [pembayarancontroller::class, 'filterTanggalCek']);
            Route::get('/filter/range', [pembayarancontroller::class, 'filterRange']);
            Route::get('/cek-harga/update', [pembayarancontroller::class, 'viewUpdate']);
        });
        // data fetching
        Route::prefix('/data')->group(function () {
            Route::get('/detail/{id}', [pembayarancontroller::class, 'detail']);
            Route::get('/detail/single/{id}', [entrycontroller::class, 'getupMethod']);
        });

        // 
        Route::prefix('/report')->group(function () {
            Route::get('/detail', [pembayarancontroller::class, 'globalReport']);
        });
    });

Route::get('/coba', function () {
    return view('coba');
});

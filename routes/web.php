<?php

use App\Http\Controllers\TesController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\userController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\dashuserController;
// use App\Http\Controllers\Homecontroller;
// use App\Http\Controllers\Authcontroller;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// Auth::routes(['verify'=>true]);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');

// Route Admin
Route::middleware('cekAdmin')->group(function () {
    Route::get('dashboard', [adminController::class, 'dashboard'])->name('dashboard');
    Route::get('transaksiAdmin', [adminController::class, 'transaksiAdmin'])->name('transaksiAdmin');
    Route::resource('pembayaranadmin', App\Http\Controllers\adminController::class);
    Route::get('aedit/{id}/edit', [adminController::class, 'aedit'])->name('aedit');
    Route::put('aupdate/{id}', [adminController::class, 'aupdate'])->name('aupdate');
    Route::delete('adestroy/{adminmp}', [adminController::class, 'adestroy'])->name('adestroy');
    Route::get('dashboard', [adminController::class, 'dashboard'])->name('dashboard');
    Route::get('kepengguna', [adminController::class, 'kepengguna'])->name('kepengguna');haha
    Route::resource('kamar', KamarController::class);
});

// Route User
Route::middleware('UserMiddleware')->group(function () {
    Route::get('dashboardUser', [dashuserController::class, 'dashboardUser'])->name('dashboardUser');
    Route::get('pesanan', [dashuserController::class, 'pesanan'])->name('pesanan');
    Route::get('riwayatuser', [dashuserController::class, 'riwayatuser'])->name('riwayatuser');
    Route::post('beli', [dashuserController::class, 'beli'])->name('beli');
    Route::get('pemesanan/{id}', [dashuserController::class, 'pemesanan'])->name('pemesanan')->middleware('web');
    Route::resource('daftar' , App\Http\Controllers\dashuserController::class);
    Route::get('search/{daftar}', [dashuserController::class, 'search'])->name('searching');
    });

Route::resource('user', UserController::class);
Route::get('logout', [UserController::class, 'logout'])->name('logout');


// Route::middleware(['guest'])->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('userdashboard');
    Route::get('register', [Usercontroller::class, 'register'])->name('register');
    Route::get('login', [Usercontroller::class, 'index'])->name('index');
    Route::post('authenticatelogin', [Usercontroller::class, 'authenticatelogin'])->name('authenticatelogin');
    Route::post('authenticate', [UserController::class, 'authenticate'])->name('authenticate');
// });

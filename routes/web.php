<?php

use App\Http\Controllers\TesController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\userController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\dashuserController;
use App\Http\Controllers\bookingController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\mailController;

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
    // Route::put('update/{id}', [adminController::class ,'update']);
    Route::resource('transaksiadminupdate' , adminController::class);
    Route::patch('terima/{id}', [adminController::class, 'terima'])->name('admin.terima');
    Route::patch('tolak/{id}', [adminController::class, 'tolak'])->name('admin.tolak');
    Route::get('transaksiAdmin', [adminController::class, 'transaksiAdmin'])->name('transaksiAdmin');
    Route::resource('pembayaranadmin', App\Http\Controllers\adminController::class);
    Route::get('aedit/{id}/edit', [adminpembeliancontroller::class, 'aedit'])->name('aedit');
    Route::delete('adestroy/{adminmp}', [adminController::class, 'adestroy'])->name('adestroy');
    Route::get('dashboard', [adminController::class, 'dashboard'])->name('dashboard');
    Route::get('kepengguna', [adminController::class, 'kepengguna'])->name('kepengguna');
    Route::resource('kamar', KamarController::class);
    Route::patch('terimapesanan',[PenggunaController::class ,'terima']);
    Route::patch('tolakpesanan',[PenggunaController::class ,'tolak']);
});

// Route User
Route::middleware('UserMiddleware')->group(function () {
    Route::get('dashboardUser', [dashuserController::class, 'dashboardUser'])->name('dashboardUser');
    Route::get('pesanan', [dashuserController::class, 'pesanan'])->name('pesanan');
    Route::get('riwayatuser', [dashuserController::class, 'riwayatuser'])->name('riwayatuser');
    Route::get('search', [dashuserController::class, 'search'])->name('searching');
    Route::get('pemesanan/{id}', [dashuserController::class, 'pemesanan'])->name('pemesanan')->middleware('web');
    Route::post('booking', [dashuserController::class, 'booking'])->name('booking');
    });

Route::resource('user', UserController::class);
Route::get('logout', [UserController::class, 'logout'])->name('logout');


// Route::middleware(['guest'])->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('userdashboard');
    Route::get('register', [Usercontroller::class, 'register'])->name('register');
    Route::get('login', [Usercontroller::class, 'index'])->name('index');
    Route::post('authenticatelogin', [Usercontroller::class, 'authenticatelogin'])->name('authenticatelogin');
    Route::post('authenticate', [UserController::class, 'authenticate'])->name('authenticate');

    // Route::get('send-email', [mailController::class, 'index']);
// });



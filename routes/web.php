<?php

use App\Http\Controllers\TesController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\userController;
use App\Http\Controllers\adminController;

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

Route::middleware('cekAdmin')->group(function () {
    Route::get('dashboardAdmin', [adminController::class, 'dashboardAdmin'])->name('dashboardAdmin');
});

Route::middleware(['userMiddleware'])->group(function () {
    Route::get('dashboardUser', [UserController::class, 'dashboardUser'])->name('dashboardUser');
});

Route::middleware(['guest'])->group(function () {

Route::resource('user', UserController::class);
Route::get('/', [UserController::class, 'dashboard'])->name('dashboard');
Route::get('register', [Usercontroller::class, 'register'])->name('register');
Route::get('login', [Usercontroller::class, 'index'])->name('index');
Route::post('authenticatelogin', [Usercontroller::class, 'authenticatelogin'])->name('authenticatelogin');
Route::post('authenticate', [UserController::class, 'authenticate'])->name('authenticate');
});


<?php

use App\Http\Controllers\TesController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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


Auth::routes(['verify'=>true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');

// Route::get('/login', [Authcontroller::class, 'login']);

// Route::get('/register', [Authcontroller::class, 'register']);
Route::get('/', function(){
    return view('auth.login');
});
Route::get('register1', function(){
    return view('register1');
});
Route::get('Dash', function(){
    return view('layouts.admin');
});

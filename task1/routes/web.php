<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;


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

Route::get('/', function () {
    return view('auth/login');
});


Route::middleware(['guest'])->group(function(){
    Route::get('/login',[AuthController::class,'LoginView'])->name('login');
    Route::post('/login',[AuthController::class,'login'])->name('login');
    
    Route::get('/register',[AuthController::class,'registerView'])->name('register');
    Route::post('/register',[AuthController::class,'register'])->name('register');
});







Route::middleware(['auth'])->group(function(){
    Route::get('/logout',[AuthController::class,'logout'])->name('logout');
    Route::get('/home',HomeController::class)->name('home');
});






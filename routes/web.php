<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomAuthController;


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
    return view('dashboard');
});

Route::resource('products', ProductController::class);
//Route::resource('auth', CustomAuthController::class);
Route::get('/login',[CustomAuthController::class,'login']) -> name('login');
Route::get('/Home',[CustomAuthController::class,'Home']) -> name('Home');
Route::get('/logout',[CustomAuthController::class,'logout']) -> name('logout');
Route::get('/registration',[CustomAuthController::class,'registration']) -> name('registration');
Route::post('/register-user',[CustomAuthController::class,'registerUser']) -> name('register-user');
Route::post('/login-user',[CustomAuthController::class,'loginUser']) -> name('login-user');



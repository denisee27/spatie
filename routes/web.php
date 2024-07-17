<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;
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


Route::get('/', function () {
    if (Auth::check()) {
        return redirect('products');
    }
    return redirect('login');
});

Route::get('/login', [LoginController::class, 'index']);
Route::get('/login/action', [LoginController::class, 'actionLogin']);
Route::group(['middleware' => 'auth'], function () {
    Route::get('/products', [ProductController::class, 'index']);
});



<?php

use App\Http\Controllers\EmailController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NavigationController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PermissionGroupController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
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

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::get('/login/action', [LoginController::class, 'actionLogin']);
Route::group(['middleware' => 'auth'], function () {
    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/roles', [RoleController::class, 'index']);
    Route::group(['prefix' => 'roles'], function () {
        Route::get('/', [RoleController::class, 'index']);
        Route::get('/{id:[a-zA-Z-?0-9]+}', 'CMS\ClusterController@index');
        Route::get('/create', [RoleController::class, 'create']);
        Route::post('/store', [RoleController::class, 'store']);
        Route::get('/update/{id}', [RoleController::class, 'show_edit']);
        Route::post('/update/store/{id}', [RoleController::class, 'update']);
        Route::delete('/delete', 'CMS\ClusterController@delete');
    });
    Route::group(['prefix' => 'menu'], function () {
        Route::get('/', [NavigationController::class, 'index']);
        Route::get('/{id:[a-zA-Z-?0-9]+}', 'CMS\ClusterController@index');
        Route::post('/create', [NavigationController::class, 'create']);
        Route::post('/update', 'CMS\ClusterController@show_edit');
        Route::delete('/delete', 'CMS\ClusterController@delete');
    });
    Route::group(['prefix' => 'permission_group'], function () {
        Route::get('/', [PermissionGroupController::class, 'index']);
        Route::post('/create', [PermissionGroupController::class, 'create']);
        Route::post('/update', [PermissionGroupController::class, 'update']);
        Route::post('/delete', [PermissionGroupController::class, 'delete']);
    });
    Route::group(['prefix' => 'permission'], function () {
        Route::get('/', [PermissionController::class, 'index']);
        Route::post('/create', [PermissionController::class, 'create']);
        Route::post('/update', [PermissionController::class, 'update']);
        Route::post('/delete', [PermissionController::class, 'delete']);
    });
    Route::group(['prefix' => 'users'], function () {
        Route::get('/', [UserController::class, 'index']);
        Route::post('/create', [UserController::class, 'create']);
        Route::post('/update', [UserController::class, 'update']);
        Route::post('/delete', [UserController::class, 'delete']);
    });
    Route::group(['prefix' => 'email'], function () {
        Route::get('/', [EmailController::class, 'index']);
        Route::post('/create', [EmailController::class, 'create']);
    });

});



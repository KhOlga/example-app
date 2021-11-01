<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('login', [LoginController::class, 'showLoginForm'])->name('show-login-form');
Route::post('login', [LoginController::class, 'authenticate'])->name('authenticate')
	->middleware('guest'); // TODO: resolve login issue

Route::get('/', [DashboardController::class, 'index'])->name('dashboard')->middleware(['auth']);

Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
	Route::get('/', [UserController::class, 'index'])->name('index');
	Route::get('data', [UserController::class, 'data'])->name('data');

	Route::get('create', [UserController::class, 'create'])->name('create');
	Route::post('create', [UserController::class, 'store'])->name('store');

	Route::get('{user}', [UserController::class, 'show'])->name('show');

	Route::get('{user}/edit', [UserController::class, 'edit'])->name('edit');
	Route::post('{user}/edit', [UserController::class, 'update'])->name('update');

	Route::delete('{user}', [UserController::class, 'destroy'])->name('destroy');
});

Route::group(['prefix' => 'roles', 'as' => 'roles.'], function () {
	Route::get('/', [RoleController::class, 'index'])->name('index');
	Route::get('data', [RoleController::class, 'data'])->name('data');

	Route::post('{role}', [RoleController::class, 'restore'])->name('restore');
	Route::delete('{role}', [RoleController::class, 'destroy'])->name('destroy');
});

Route::group(['prefix' => 'permissions', 'as' => 'permissions.'], function () {
	Route::get('/', [PermissionController::class, 'index'])->name('index');
	Route::get('data', [PermissionController::class, 'data'])->name('data');

	Route::post('{permission}', [PermissionController::class, 'restore'])->name('restore');
	Route::delete('{permission}', [PermissionController::class, 'destroy'])->name('destroy');
});

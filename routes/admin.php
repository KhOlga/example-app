<?php

use App\Http\Controllers\Admin\LoginController;
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
Route::post('login', [LoginController::class, 'authenticate'])->name('authenticate');

Route::get('/', function () {
	return view('admin.dashboard');
});


//require __DIR__.'/auth.php';

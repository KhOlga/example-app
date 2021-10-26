<?php

use App\Http\Controllers\SubscriptionController;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::middleware(['auth'])->group(function () {
	Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
		Route::group(['prefix' => 'subscriptions', 'as' => 'subscriptions.'], function () {
			Route::get('/', [SubscriptionController::class, 'index'])->name('index');

			Route::get('subscribe', [SubscriptionController::class, 'subscribe'])->name('subscribe');
			Route::post('subscribe-store', [SubscriptionController::class, 'subscriptionStore'])->name('subscription_store');

			Route::get('subscriptionShow', [SubscriptionController::class, 'subscriptionShow'])->name(
				'subscription_show'
			);

			Route::get('{subscription}/edit-subscription}', [SubscriptionController::class, 'editSubscription'])->name(
				'edit_subscription'
			);
			Route::post('{subscription}/edit-subscription}', [SubscriptionController::class, 'updateSubscription']
			)->name('update-subscription');

			Route::delete('{subscription}', [SubscriptionController::class, 'destroy'])->name('destroy');
		});
	});
});
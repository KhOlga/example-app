<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function index()
	{
		return 123;
	}

	public function subscribe()
	{
		return view('users.subscriptions.subscribe');
	}

	public function subscriptionStore(Request $request)
	{
		$request->user()->newSubscription(
			'default', 'price_monthly'
		)->create($request->paymentMethodId);
		//dd($request->all());
	}

	public function subscriptionShow()
	{
		//
	}

	public function editSubscription()
	{
		//
	}

	public function updateSubscription()
	{
		//
	}

	public function destroy()
	{
		//
	}
}

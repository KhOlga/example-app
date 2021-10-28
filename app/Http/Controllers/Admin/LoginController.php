<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Fortify;

class LoginController extends Controller
{
	/**
	 * Show the application's login form.
	 *
	 * @return \Illuminate\View\View
	 */
	public function showLoginForm()
	{
		return view('admin.auth.login');
	}


	/*public function store(LoginRequest $request)
	{
		$request->authenticate();

		$request->session()->regenerate();

		return redirect()->intended(RouteServiceProvider::HOME);
	}*/

	/**
	 * Handle an authentication attempt.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function authenticate(Request $request)
	{
		$credentials = $this->validateLogin($request);
		dd($credentials);

		if (Auth::attempt($credentials)) {
			//$request->session()->regenerate();

			return redirect()->intended(RouteServiceProvider::ADMIN);
		}

		return back()->withErrors([
			'email' => 'The provided credentials do not match our records.',
		]);
	}

	/**
	 * Validate the user login request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return void
	 *
	 * @throws \Illuminate\Validation\ValidationException
	 */
	protected function validateLogin(Request $request)
	{
		$request->validate([
			'email' => 'required|email|exists:users',
			'password' => 'required|string',
		]);
	}
}

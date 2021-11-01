<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
	 * @param  string|null $guard
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $guard = null)
    {
		if (Auth::guard($guard)->check()) {
			$email = $request->get('email');

			if (User::isSuperAdmin($email) === true && $request->is('admin*')) {
				return redirect(RouteServiceProvider::ADMIN);
			}

			if (User::findByEmail($email) === null) {
				return redirect(RouteServiceProvider::MAIN_PAGE);
			}

			if (User::findByEmail($email) === true) {
				return redirect(RouteServiceProvider::HOME);
			}
		}
        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
		$email = $request->input('email');

		if(User::isSuperAdmin($email) === true) {
			return redirect(RouteServiceProvider::ADMIN);
		}

		if(User::findByEmail($email) === null) {
			return redirect(RouteServiceProvider::MAIN_PAGE);
		}

		if (User::findByEmail($email) === true) {
			return redirect(RouteServiceProvider::HOME);
		}

        return $next($request);
    }
}

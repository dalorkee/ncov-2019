<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use Auth;

class ChkUserRole
{
	public function handle($request, Closure $next) {
		/* set role name to session */
		if (!Session::has('user_role')) {
			//roleArr = auth()->user()->roles->pluck('name')->toArray();
			$roleArr = auth()->user()->getRoleNames()->toArray();
			$user_role = $roleArr[0];
			Session::put('user_role', $user_role);
			return $next($request);
		}
	}
}

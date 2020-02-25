<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use Auth;

class PageSession
{
	/**
	* Handle an incoming request.
	*
	* @param  \Illuminate\Http\Request  $request
	* @param  \Closure  $next
	* @return mixed
	*/
	public function handle($request, Closure $next) {
		/* set role name to session */
		if (!Session::has('user_role_name')) {
			$roleArr = auth()->user()->roles->pluck('name');
			$userRole = $roleArr[0];
			Session::put('user_role_name', $userRole);
		}
	}
}

<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use Redirect;
//use App\DdcAuth;

class DdcAuthenPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
	{
		if (Session::had('list')) {
			$user_list = Session::get('list');
			echo $user_list;
			exit;
		}
		return $next($request);
	}
}

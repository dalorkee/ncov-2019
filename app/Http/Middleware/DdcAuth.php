<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\Controllers\DdcAuthController;
use Session;

class DdcAuth extends DdcAuthController
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
		parent::index($request);
		return $next($request);

	}
}

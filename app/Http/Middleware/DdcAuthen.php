<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use Redirect;
use App\DdcAuth;

class DdcAuthen
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
		if ($request->idx) {
			$chk_ddc_user = DdcAuth::where('id', '=', $request->idx)->get()->toArray();
			if (count($chk_ddc_user) > 0) {
				$ddc_user = ['id' => $chk_ddc_user[0]['id'], 'list' => $chk_ddc_user[0]['list']];
				$request->session()->put('ddc_user', $ddc_user);
				return $next($request);
			} else {
				//return Redirect::to('http://viral.local/');
				return Redirect::to('http://viral.ddc.moph.go.th/viral/index.php');
			}
		} else {
			//return Redirect::to('http://viral.local/');
			return Redirect::to('http://viral.ddc.moph.go.th/viral/index.php');
		}
    }
}

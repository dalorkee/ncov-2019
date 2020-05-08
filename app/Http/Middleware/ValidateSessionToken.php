<?php

namespace App\Http\Middleware;

use Closure;
use App\SessionToken;
use Illuminate\Support\Facades\Auth;

class ValidateSessionToken
{
	public function handle($request, Closure $next) {
		$token = SessionToken::where('user_id', Auth::id())->orderBy('created_at', 'DESC')->first()->token;
		if ($request->session()->get('token') != $token) {
			return redirect('/logout')->with('error', 'บัญชีนี้ล็อกอินในอุปกรณ์อื่น โปรดตรวจสอบการใช้งานบัญชี');
		}
		return $next($request);
	}
}

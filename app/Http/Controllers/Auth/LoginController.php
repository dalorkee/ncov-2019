<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Illuminate\Http\Request;
use Session;
use App\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

	use AuthenticatesUsers;

	/**
	* Where to redirect users after login.
	*
	* @var string
	*/
	protected $redirectTo = '/home';
	protected $username = 'username';
	/**
	* Create a new controller instance.
	*
	* @return void
	*/
	public function __construct()
	{
		$this->middleware('guest')->except('logout');
	}

	public function username()
	{
		return 'username';
	}

	/* *** *** *** */
	/* Note *** Using md5() over bcrypt() is not recommended. *** */
	public function login(Request $request){
		$user = User::where('username', $request->username)
			->where('password', md5($request->password))->first();
		Auth::login($user);
		return redirect('/');
	}
	/* Note *** if don't use md5 remove login override method at once  */
	/* *** *** *** */


	public function logout(Request $request) {
		Auth::logout();
		Session::flush();
		return redirect('/login');
	}
}

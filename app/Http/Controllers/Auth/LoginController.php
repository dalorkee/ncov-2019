<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Illuminate\Http\Request;
use Session;
use App\User;
use Carbon\Carbon;
use Validator;
use DB;

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
		if($user==null){
			$message = "ไม่สามารถเข้าสู่ระบบได้ กรุณาตรวจสอบชื่อผู้ใช้งานหรีอรหัสผ่าน";
			flash()->overlay($message, 'Message From System');
			//return redirect('/login')->with('message','ไม่สามารถเข้าสู่ระบบได้ กรุณาตรวจสอบชื่อผู้ใช้งานหรีอรหัสผ่าน');
			return redirect('/login');
		}else{
			Auth::login($user);
			return redirect('/');
		}
		//return redirect('/');
	}
	/* Note *** if don't use md5 remove login override method at once  */
	/* *** *** *** */


	public function logout(Request $request) {
		Auth::logout();
		Session::flush();
		return redirect('/login');
	}

	public function get_check_auth(Request $request) {

	$rules = [
			'userid'=>'required',
			'ts'=>'required|digits_between:10,15',
			'sig'=>'required'
	];

	$validator = Validator::make($request->all(), $rules);

				if ($validator->fails()) {
						$error = [];
						$error["status"]    = "error";
						$error["message"]   = "error_require_data";
						$error["hospital"]  = [];

						return response()->json($error,200);
				}

				$signature = env('SIGNATURE_KEY');
				$user = $request->input('userid');
				$ts = $request->input('ts');
				$sig = $request->input('sig');

				$to     = Carbon::createFromTimestamp($ts);
				$from   = Carbon::createFromFormat('Y-m-d H:i:s', date("Y-m-d H:i:s"));
				$diff_in_minutes = $to->diffInMinutes($from);

				// check timestamp expire
				if($diff_in_minutes>30) {
						// $error = [];
						// $error["status"]    = "error";
						// $error["message"]   = "error_time_expire";
						//return response()->json($error,200);
						$message = "รหัสหมดอายุ (Token Expire) กรุณา Refresh หน้า Login ( http://viral.ddc.moph.go.th/viral/main/index.php ) อีกครั้ง";
						return response()->view('errors.auth_key',[
							"message" => $message
						]);
				}

				// check signature
				$signatureMD5 = sha1($user.$ts.$signature);

				dd($sig,$signatureMD5);

				if($sig!=$signatureMD5) {
						// $error = [];
						// $error["status"]    = "error";
						// $error["message"]   = "error_signature";
						// return response()->json($error,200);
						$message = "รหัสไม่ถูกต้อง(Token Invalid)";
						return response()->view('errors.auth_key',[
							"message" => $message
						]);
				}
				// AUTH with user & redirect to page.
				//check username_ad in MysqlDB
				$findUser = User::where('username_ad',trim($user))->get()->first();
				if(!is_null($findUser)){
					if(Auth::loginUsingId($findUser->id)){
						//Auth successful here
						return redirect('/home');
					}else{
						//Auth failed
						// $error = [];
						// $error["status"]    = "error";
						// $error["message"]   = "error_userID_not_found";
						// return response()->json($error,200);
						$message = "ไม่พบ UserID ในระบบฐานข้้อมูล GISTDA-HR !";
						return response()->view('errors.auth_key',[
							"message" => $message
						]);
					}
				}else{
					// $error = [];
					// $error["status"]    = "error";
					// $error["message"]   = "error_username_ad_not_found";
					// return response()->json($error,200);
					$message = "ไม่พบชื่อผู้ใช้งาน ".$user." ในระบบฐานข้้อมูล GISTDA-HR !";
					return response()->view('errors.auth_key',[
						"message" => $message
					]);
				}
	}
}

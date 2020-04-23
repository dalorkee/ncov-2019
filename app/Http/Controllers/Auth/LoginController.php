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
						//$error["hospital"]  = [];

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
				$findUser = User::where('id',trim($user))->get()->first();
				//dd($findUser);
				if(!is_null($findUser)){
					if(Auth::loginUsingId($findUser->id)){
						$data = [
							'user_id' => trim($findUser->id),
							'ip_addr' => request()->ip(),
							'created_at' => Carbon::now()->toDateTimeString()
						];
						//dd($data);
						DB::table('log_bypass_auth')->insert($data);
						$line_notify_token = "1ATz8CaB3sG9NIKo7RNO39vyuMG5Ze2Orq6GWGiRabW";
						$response = "มีคุณ ".$findUser->name." ".$findUser->lname." สิทธิ์ ".$findUser->wposi."เข้าใช้งานระบบ ByPassAuthen ที่ IP ".request()->ip();
						//$this->line_notify($line_notify_token,$response);
						//Auth successful here
						return redirect('/');
					}else{
						//Auth failed
						// $error = [];
						// $error["status"]    = "error";
						// $error["message"]   = "error_userID_not_found";
						// return response()->json($error,200);
						$message = "ไม่พบ User ในระบบฐานข้้อมูล !";
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
	public function line_notify($Token, $message)
  {
    $lineapi = $Token;
  	$mms =  trim($message);
  	date_default_timezone_set("Asia/Bangkok");
  	$chOne = curl_init();
  	curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify");
  	// SSL USE
  	curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0);
  	curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0);
  	//POST
  	curl_setopt( $chOne, CURLOPT_POST, 1);
  	curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=$mms");
  	curl_setopt( $chOne, CURLOPT_FOLLOWLOCATION, 1);
  	$headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$lineapi.'', );
          curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers);
  	curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1);
  	$result = curl_exec( $chOne );
  	//Check error
  	if(curl_error($chOne))
  	{
             echo 'error:' . curl_error($chOne);
  	}
  	else {
  	$result_ = json_decode($result, true);
  	   //echo "status : ".$result_['status']; echo "message : ". $result_['message'];
       echo $result_['message'];
          }
  	curl_close( $chOne );
  }
}

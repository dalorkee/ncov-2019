<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Validator, Log, Session;
use App\User;
use App\Traits\BoundaryTrait;

class LoginController extends Controller {
	use AuthenticatesUsers;
	use BoundaryTrait;

	protected $redirectTo = '/home';
	protected $username = 'username';

	public function __construct() {
		$this->middleware('guest')->except('logout');
	}

	public function username() {
		return 'username';
	}

	public function loginForm() {
		return view('auth.login');
	}

	/* *** *** *** */
	/* Note *** Using md5() over bcrypt() is not recommended. *** */
	public function login(Request $request) {
		try {
			$pdo = \DB::connection()->getPDO();
			if (!$pdo) {
				Log::error('ไม่สามารถเชื่อมต่อฐานข้อมูล');
				return redirect('login')->with('error', 'ไม่สามารถเชื่อมต่อฐานข้อมูลได้ โปรดติดต่อผู้ดูแลระบบฯ');
			} else {
				$user = User::where('username', $request->username)->where('password', md5($request->password))->first();
				if (!is_null($user)) {
					Auth::login($user);
					if (Auth::check()) {
						return redirect('home');
					} else {
						return redirect('logout');
					}
				} else {
					return redirect('login')->with('error', 'Username หรือ Password ไม่ถูกต้อง');
				}
			}
		} catch(\Exception $e) {
			Log::error(sprintf("%s - line %d - ", __FILE__, __LINE__).$e->getMessage());
		}
	}

	public function logout(Request $request) {
		try {
			(Session::has('error')) ? $err_msg = Session::get('error') : $err_msg = null;
			if (Auth::check()) {
				$user = Auth::user();
				$user_permissions = $user->permissions;
				if ($user_permissions->count() > 0) {
					foreach ($user_permissions as $key => $val) {
						$user->revokePermissionTo($val->name);
					}
				}
			}
			Auth::logout();
			Session::flush();
			if (!is_null($err_msg)) {
				return redirect('/login')->with('error', $err_msg);
			} else {
				return redirect('/login');
			}
		} catch(\Exception $e) {
			Log::error('Login Error Na ja');
			Log::error(sprintf("%s - line %d - ", __FILE__, __LINE__).$e->getMessage());
		}
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
			return response()->json($error,200);
		}

		$signature = "bd6efdd618ef8e481ba2e247b10735b801fbdefe";
		$user = $request->input('userid');
		$ts = $request->input('ts');
		$sig = $request->input('sig');

		$to = Carbon::createFromTimestamp($ts);
		$from = Carbon::createFromFormat('Y-m-d H:i:s', date("Y-m-d H:i:s"));
		$diff_in_minutes = $to->diffInMinutes($from);

		if ($diff_in_minutes>60) {
			$message = "รหัสหมดอายุ (Token Expire) กรุณา Refresh หน้า Login ( http://viral.ddc.moph.go.th/ ) อีกครั้ง";
			return response()->view('errors.auth_key',[
				"message" => $message
			]);
		}

		$signatureMD5 = sha1($user.$ts.$signature);
		if ($sig!=$signatureMD5) {
			$message = "รหัสไม่ถูกต้อง(Token Invalid)";
			return response()->view('errors.auth_key', [
				"message" => $message
			]);
		}
		$findUser = User::where('id',trim($user))->get()->first();
		if (!is_null($findUser)) {
			if (Auth::loginUsingId($findUser->id)) {
				$data = [
					'user_id' => trim($findUser->id),
					'ip_addr' => request()->ip(),
					'created_at' => Carbon::now()->toDateTimeString(),
				];
				DB::table('log_bypass_auth')->insert($data);
				return redirect('/');
			} else {
				$message = "ไม่พบ User ในระบบฐานข้้อมูล !";
				return response()->view('errors.auth_key',[
					"message" => $message
				]);
			}
		} else {
			$message = "ไม่พบชื่อผู้ใช้งาน ".$user." ในระบบฐานข้้อมูล GISTDA-HR !";
			return response()->view('errors.auth_key',[
				"message" => $message
			]);
		}
	}

	public function line_notify($Token, $message) {
		$lineapi = $Token;
		$mms =  trim($message);
		date_default_timezone_set("Asia/Bangkok");
		$chOne = curl_init();
		curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify");
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
			if(curl_error($chOne)) {
				echo 'error:' . curl_error($chOne);
			} else {
				$result_ = json_decode($result, true);
				echo $result_['message'];
			}
			curl_close( $chOne );
		}
	}

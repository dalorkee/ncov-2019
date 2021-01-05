<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use App\User;
use App\Traits\BoundaryTrait;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
	use BoundaryTrait;
	protected $hospcode;

	public function __construct() {
		$this->middleware('auth');
		$this->middleware('onlyOneUser');
		$this->middleware(['role:root|ddc|dpc|pho|hos']);
	}

	public function index(Request $request) {
		$user = Auth::user();
		$user_role = $user->roles->pluck('name')->all();
		$user_hosp = $user->hospcode;
		if ($user_role[0] == 'root') {
			$data = User::orderBy('id', 'ASC')->paginate(15);
		} else {
			$data = User::where('hospcode', $user_hosp)->orderBy('id', 'ASC')->paginate(15);
		}
		return view('users.index', compact('data'))->with('i', ($request->input('page', 1) - 1) * 15);
	}

	public function create() {
		$provinces = self::getProvince();
		$user = Auth::user();
		$user_role = $user->roles->pluck('name')->all();
		if ($user_role[0] == 'root') {
			$roles = Role::pluck('name', 'name')->all();
		} else {
			$roles = array($user_role[0] => $user_role[0]);
		}
		return view('users.create', compact('roles', 'provinces'));
	}

	public function store(Request $request) {
		try {
			$this->validate($request, [
				'title_name' => 'required',
				'name' => 'required',
				'lname' => 'required',
				'email' => 'required|email|unique:users,email',
				'tel' => 'required',
				'usergroup' => 'required',
				'card_id' => 'required',
				'prov_code' => 'required',
				'hospcode' => 'required',
				'username' => 'required',
				'password' => 'required|same:confirm_password',
				'roles' => 'required'
			]);

			$input = $request->all();
			$input['wposi'] = '';
			$input['dtnow'] = date('Y-m-d H:i:s');
			$input['prefix_sat_id'] = $input['hospcode'];
			$input['ampur_code'] = substr($input['ampur_code'], 2, 4);
			$input['tambol_code'] = substr($input['tambol_code'], 4, 6);
			//$input['password'] = Hash::make($input['password']);
			$input['password'] = md5($input['password']);
			$user = User::create($input);
			$user->assignRole($request->input('roles'));

			/* set user data to log_user table */
			if ($user) {
				$now = date('Y-m-d H:i:s');
				DB::table('log_users')->insert([
					'user_id' => $user->id,
					'username' => $user->username,
					'create_by_user' => Auth::user()->username,
					'user_group' => $user->usergroup,
					'user_permission' => $request->input('roles'),
					'created_at' => $now
				]);
				Log::notice('ผู้ใช้: '.Auth::user()->username.' สร้างผู้ใช้ '.$user->username);
			}
			return redirect()->route('users.index')->with('success', 'User created successfully');
		} catch (Exception $e) {

		}
	}

	public function show($id) {
		$user = User::find($id);
		return view('users.show', compact('user'));
	}

	public function edit($id) {
		$user = User::find($id);
		$roles = Role::pluck('name', 'name')->all();
		$userRole = $user->roles->pluck('name', 'name')->all();

		return view('users.edit', compact('user', 'roles', 'userRole'));
	}

	public function update(Request $request, $id) {
		$this->validate($request, [
			'name' => 'required',
			'lname' => 'required',
			'password' => 'same:confirm-password',
			'email' => 'required|email|unique:users,email,'.$id,
			'roles' => 'required'
		]);

		$input = $request->all();
		if (!empty($input['password'])) {
			/* $input['password'] = Hash::make($input['password']); */
			$md5pwd = md5($input['password']);
			$input['password'] = $md5pwd;
		} else {
			$input = array_except($input, array('password'));
		}

		$user = User::find($id);
		$user->update($input);
		DB::table('model_has_roles')->where('model_id',$id)->delete();
		$user->assignRole($request->input('roles'));

		return redirect()->route('users.index')->with('success', 'User updated successfully');
	}

	public function destroy($id) {
		User::find($id)->delete();
		return redirect()->route('users.index')->with('success', 'User deleted successfully');
	}

	public function download(Request $request) {
		(new UsersExport)->store('users.csv', 'excel');
		return 'Export started!';
	}

	public function ajaxGetHospByProv(Request $request) {
		$this->result = parent::hospitalByProv($request->prov_id);
		$htm = "<option value=\"0\">-- โปรดเลือก --</option>\n";
		foreach($this->result as $key=>$value) {
				$htm .= "<option value=\"".$value->hospcode."\">".$value->hosp_name."</option>\n";
		}
		return $htm;
	}

	public function getUserByHospCode($hosp_code=0) {
		//$hosp_code = auth()->user()->hosp_code;
		$users = User::select('id')->where('hospcode', '=', $hosp_code)->get()->toArray();
		$user_arr = array();
		foreach ($users as $key => $val) {
			array_push($user_arr, $val['id']);
		}
		return $user_arr;
	}

	public function getPhoUserByProv(Request $request, $prov_code) {
		//$prov_code = auth()->user()->prov_code;
		$users = User::select('id')->where('prov_code', '=', $prov_code)->get()->toArray();
		$user_arr = array();
		foreach ($users as $key => $val) {
			array_push($user_arr, $val['id']);
		}
		return $user_arr;
	}
}

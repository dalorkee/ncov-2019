<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;
use App\User;
use App\Traits\BoundaryTrait;
use App\Traits\UserTrait;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
	use BoundaryTrait;
	use UserTrait;

	protected $hospcode;

	public function __construct() {
		$this->middleware('auth');
		$this->middleware('onlyOneUser');
		$this->middleware(['role:root|ddc|dpc|pho|hos|lab']);
	}

	public function search(Request $request) {
		$input = $request->all();
		$str = trim($input['usr_search']);
		if (!is_null($str) || !empty($str) || $str != "") {
			$user = Auth::user();
			$user_hosp = $user->hospcode;
			if ($user->hasRole('root')) {
				$chkCreateUserAmount = '&infin;';
				$data = User::where('username', 'like', '%'.$str.'%')->orderBy('id', 'ASC')->paginate(15);
				return view('users.index', compact('data', 'chkCreateUserAmount'))->with('i', ($request->input('page', 1) - 1) * 15);
			} else {

			}
		}
	}

	public function index(Request $request) {
		$user = Auth::user();
		$user_hosp = $user->hospcode;
		if ($user->hasRole('root')) {
			$chkCreateUserAmount = '&infin;';
			$data = User::orderBy('id', 'ASC')->paginate(15);
		} else {
			if ($user->hasPermissionTo('user-create')) {
				$chkCreateUserAmount = self::checkCreateRemaining($user->username);
				$log_user_id = DB::table('log_users')
					->select('user_id')
					->where('create_by_user', $user->username)
					->get()
					->toArray();
				if (count($log_user_id) > 0) {
					foreach ($log_user_id as $key => $val) {
						$log_user_id_arr[] = $val->user_id;
					}
					$data = User::where('hospcode', '=', (int)$user_hosp)
						->orWhere(function($w) use ($log_user_id_arr) {
							$w->whereIn('id', $log_user_id_arr);
						})
						->orderBy('id', 'ASC')
						->paginate(15);
				} else {
					$data = User::where('hospcode', '=', (int)$user_hosp)->orderBy('id', 'ASC')->paginate(15);
				}
			} else {
				$chkCreateUserAmount = 'forbidden';
				$data = User::where('hospcode', '=', (int)$user_hosp)->orderBy('id', 'ASC')->paginate(15);
			}
		}
		return view('users.index', compact('data', 'chkCreateUserAmount'))->with('i', ($request->input('page', 1) - 1) * 15);
	}

	public function create() {
		$user = Auth::user();
		$user_role = $user->roles->pluck('name')->all();
		$chkCreateUserAmount = self::checkCreateRemaining($user->username);
		if ($chkCreateUserAmount > 0 || $user->hasRole('root')) {
			$provinces = self::getMinProvince();
			asort($provinces);
			$user_group = self::userGroup();
			$permissions = Permission::all();
			switch ($user_role[0]) {
				case 'root':
					break;
				case 'ddc':
					break;
				case 'dpc':
					unset($user_group[1]);
					break;
				case 'pho':
					unset($user_group[1]);
					unset($user_group[3]);
					break;
				case 'hos':
					unset($user_group[1]);
					unset($user_group[3]);
					unset($user_group[8]);
					break;
				case 'lab':
					unset($user_group[1]);
					unset($user_group[3]);
					unset($user_group[8]);
					unset($user_group[7]);
					break;
				default:
					return redirect()->route('logout');
					break;
			}
			return view('users.create', compact('provinces', 'user_group', 'permissions'));
		} else {
			return redirect()->route('users.index')->with('error', 'ไมีมีสิทธิ์สร้างผู้ใช้ หรือสร้างผู้ใช้ครบตามสิทธ์แล้ว !!');
		}
	}

	public function store(Request $request) {
		try {
			$this->validate($request, [
				'title_name' => 'required',
				'name' => 'required|max:30',
				'lname' => 'required|max:60',
				'email' => 'required|email|unique:users,email|max:60',
				'tel' => 'required|max:10',
				'usergroup' => 'required',
				'card_id' => 'required|max:13',
				'prov_code' => 'required',
				'hospcode' => 'required',
				'username' => 'required|max:30',
				'password' => 'required|same:confirm_password|min:6|max:30',
				'roles' => 'required'
			]);
			$input = $request->all();
			if (self::checkRepeatUsername($input['username'])) {
				return redirect()->route('users.index')->with('error', 'ชือผู้ใช้ '.$input['username'].' มีอยู่ในระบบแล้ว !!');
			} else {
				$user = Auth::user();
				$user_role = $user->roles->pluck('name')->all();
				if ($user_role[0] == 'root') {
					$user->givePermissionTo('user-create');
				}
				$input['wposi'] = '';
				$input['dtnow'] = date('Y-m-d H:i:s');
				$input['prefix_sat_id'] = $input['hospcode'];
				$input['ampur_code'] = substr($input['ampur_code'], 2, 4);
				$input['tambol_code'] = substr($input['tambol_code'], 4, 6);
				//$input['password'] = Hash::make($input['password']);
				$input['password'] = md5($input['password']);
				$user = User::create($input);
				$user->assignRole($request->input('roles'));

				/* save user data to log_user table */
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
			}
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	public function show($id) {
		$user = User::find($id);
		$user_hosp_name = self::getHospNameByHospCode($user->hospcode);
		$user_group = self::userGroup();
		return view('users.show', compact('user', 'user_hosp_name', 'user_group'));
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

	private function checkRepeatUsername($str=null): bool {
		$user = User::select('id')->where('username', $str)->get()->toArray();
		if (count($user) > 0) {
			return true;
		} else {
			return false;
		}
	}

	private function checkCreateRemaining($username=null): ?string {
		$count = DB::table('log_users')->where('create_by_user', $username)->count();
		$limit = 6;
		if ($count == $limit) {
			$result = 0;
		} else {
			$result = ($limit-$count);
		}
		return $result;
	}
}

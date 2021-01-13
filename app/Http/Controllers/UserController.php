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

	public function index(Request $request) {
		try {
			$user = Auth::user();
			$direct_username = self::directAllowCreateNewUserTo();
			if ($user->hasRole('root') || in_array($user->username, $direct_username)) {
				$chkCreateUserAmount = '&infin;';
				$data = User::orderBy('id', 'ASC')->paginate(15);
			} else {
				$chkCreateUserAmount = self::checkCreateRemaining($user->username);
				if ($user->create_user_permission == 'y' && $chkCreateUserAmount > 0) {
					$log_user_id = DB::table('log_users')->select('user_id')->where('create_by_user', $user->username)->get()->toArray();
					if (count($log_user_id) > 0) {
						foreach ($log_user_id as $key => $val) {
							$log_user_id_arr[] = $val->user_id;
						}
						$data = User::where('hospcode', '=', $user->hospcode)
							->orWhere(function($w) use ($log_user_id_arr) {
								$w->whereIn('id', $log_user_id_arr);
							})->orderBy('id', 'ASC')->paginate(15);
					} else {
						$data = User::where('hospcode', '=', $user->hospcode)->orderBy('id', 'ASC')->paginate(15);
					}
				} else {
					$data = User::where('hospcode', '=', $user->hospcode)->orderBy('id', 'ASC')->paginate(15);
				}
			}
			return view('users.index', compact('data', 'chkCreateUserAmount'))->with('i', ($request->input('page', 1) - 1) * 15);
		} catch (Exception $e) {
			Log::error($e->getMessage());
		}
	}

	public function search(Request $request) {
		try {
			$input = $request->all();
			$str = trim($input['usr_search']);
			if (strlen($str) > 0) {
				$user = Auth::user();
				$direct_username = self::directAllowCreateNewUserTo();
				if ($user->hasRole('root') || in_array($user->username, $direct_username)) {
					$chkCreateUserAmount = '&infin;';
					$data = User::where('username', 'like', '%'.$str.'%')->orderBy('id', 'ASC')->paginate(15);
				} else {
					$chkCreateUserAmount = self::checkCreateRemaining($user->username);
					$log_user_id = DB::table('log_users')->select('user_id')->where('create_by_user', $user->username)->get()->toArray();
					if (count($log_user_id) > 0) {
						foreach ($log_user_id as $key => $val) {
							$log_user_id_arr[] = $val->user_id;
						}
						$log_user_id_arr[] = $user->id;
					} else {
						$log_user_id_arr[] = $user->id;
					}
					$data = User::where('username', 'like', '%'.$str.'%')->whereIn('id', $log_user_id_arr)->orderBy('id', 'ASC')->paginate(15);
				}
				return view('users.index', compact('data', 'chkCreateUserAmount'))->with('i', ($request->input('page', 1) - 1) * 15);
			} else {
				return redirect()->route('users.index')->with('error', 'โปรดกรอกข้อมูลที่ต้องการค้นหา!!');
			}
		} catch (Exception $e) {
			Log::error($e->getMessage());
		}
	}

	public function create() {
		$user = Auth::user();
		$chkCreateUserAmount = self::checkCreateRemaining($user->username);
		if ($chkCreateUserAmount > 0 || $user->hasRole('root')) {
			$provinces = self::getMinProvince();
			asort($provinces);
			$user_group = self::userGroup();
			$user_role = $user->roles->pluck('name')->all();
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
			return view('users.create', compact('provinces', 'user_group', 'user'));
		} else {
			return redirect()->route('users.index')->with('error', 'ไม่มีสิทธิ์สร้างผู้ใช้ หรือสร้างผู้ใช้ครบตามสิทธ์แล้ว !!');
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
				'create_user_permission' => 'required'
			]);
			$input = $request->all();
			if (self::checkRepeatUsername($input['username'])) {
				return redirect()->route('users.index')->with('error', 'ชือผู้ใช้ '.$input['username'].' มีอยู่ในระบบแล้ว !!');
			} else {
				$user = Auth::user();
				$input['wposi'] = '';
				$input['dtnow'] = date('Y-m-d H:i:s');
				$input['prefix_sat_id'] = $input['hospcode'];
				if (!is_null($input['ampur_code']) && !empty($input['ampur_code']) && $input['ampur_code'] != "") {
					$input['ampur_code'] = substr($input['ampur_code'], 2, 4);
				} else {
					$input['ampur_code'] = null;
				}
				if (!is_null($input['tambol_code']) && !empty($input['tambol_code']) && $input['tambol_code'] != "") {
					$input['tambol_code'] = substr($input['tambol_code'], 4, 6);
				} else {
					$input['tambol_code'] = null;
				}
				//$input['password'] = Hash::make($input['password']);
				$input['password'] = md5($input['password']);
				$new_user = User::create($input);

				/* assign role */
				$map_usergroup_to_role = self::mapUserGroupToUserRole();
				$assign_role = $map_usergroup_to_role[(int)$input['usergroup']];
				$new_user->assignRole($assign_role);

				/* save user data to log_user table */
				if ($new_user) {
					$now = date('Y-m-d H:i:s');
					DB::table('log_users')->insert([
						'user_id' => $new_user->id,
						'username' => $new_user->username,
						'create_by_user' => $user->username,
						'user_group' => $new_user->usergroup,
						'user_role' => $assign_role,
						'created_at' => $now
					]);
					Log::notice('ผู้ใช้: '.$user->username.' สร้างผู้ใช้ '.$new_user->username);
				}
				return redirect()->route('users.index')->with('success', 'User created successfully');
			}
		} catch (Exception $e) {
			Log::error($e->getMessage());
		}
	}

	public function show($id) {
		$user = User::find($id);
		$user_hosp_name = self::getHospNameByHospCode($user->hospcode);
		$user_group = self::userGroup();
		return view('users.show', compact('user', 'user_hosp_name', 'user_group'));
	}

	public function edit($id) {
		try {
			$user = User::find($id);
			if (!is_null($user->usergroup) && !empty($user->usergroup) && $user->usergroup != "") {
				$user_role_arr = $user->roles->pluck('name')->all();
				if (count($user_role_arr) <= 0) {
					/* assign role to new_user */
					$map_usergroup_to_role = self::mapUserGroupToUserRole();
					$assign_role = $map_usergroup_to_role[(int)$user->usergroup];
					$user->assignRole($assign_role);
				}

				$titleName = self::userTitleName();
				$provinces = self::getMinProvince();
				asort($provinces);

				$user_dist = self::getDistrictDetailByDistrictId($user->prov_code.$user->ampur_code)->toArray();
				$user_dist = (count($user_dist) > 0) ? $user_dist : null;

				$user_sub_dist = self::getSubDistrictDetailBySubDistrictId($user->prov_code.$user->ampur_code.$user->tambol_code)->toArray();
				$user_sub_dist = (count($user_sub_dist) > 0) ? $user_sub_dist : null;

				$user_hosp = self::getHospNameByHospCode($user->hospcode);
				$user_hosp = (count($user_hosp) > 0) ? $user_hosp : null;

				$user_group = self::userGroup();

				$auth_user = Auth::user();
				$auth_user_role_arr = $auth_user->roles->pluck('name')->all();
				switch ($auth_user_role_arr[0]) {
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
				return view('users.edit', compact('user', 'user_dist', 'user_sub_dist', 'titleName', 'provinces', 'user_hosp', 'user_group'));
			}
		} catch (Exception $e) {
			Log::error($e->getMessage());
		}
	}

	public function update(Request $request, $id) {
		try {
			$this->validate($request, [
				'title_name' => 'required',
				'name' => 'required|max:30',
				'lname' => 'required|max:60',
				'tel' => 'required|max:10',
				'card_id' => 'required|max:13',
				'prov_code' => 'required',
				'hospcode' => 'required',
				'username' => 'required|max:30',
				'password' => 'same:confirm_password|max:30',
				'usergroup' => 'required',
				'create_user_permission' => 'required'
			]);

			$input = $request->all();
			$input['prefix_sat_id'] = $input['hospcode'];
			if (!is_null($input['ampur_code']) && !empty($input['ampur_code']) && $input['ampur_code'] != "") {
				$input['ampur_code'] = substr($input['ampur_code'], 2, 4);
			} else {
				$input['ampur_code'] = null;
			}
			if (!is_null($input['tambol_code']) && !empty($input['tambol_code']) && $input['tambol_code'] != "") {
				$input['tambol_code'] = substr($input['tambol_code'], 4, 6);
			} else {
				$input['tambol_code'] = null;
			}
			if (!empty($input['password'])) {
				$md5pwd = md5($input['password']); /* $input['password'] = Hash::make($input['password']); */
				$input['password'] = $md5pwd;
			} else {
				$input = array_except($input, array('password'));
			}

			$auth_user = Auth::user();
			$user = User::find($id);
			$user->update($input);
			Log::notice('ผู้ใช้: '.$auth_user->username.' สร้างผู้ใช้ '.$user->username);

			/*
			DB::table('model_has_roles')->where('model_id',$id)->delete();
			$user->assignRole($request->input('roles'));
			*/

			return redirect()->route('users.index')->with('success', 'User updated successfully');
		} catch (Exception $e) {
			Log::error($e->getMessage());
		}
	}

	public function destroy($id) {
		User::find($id)->delete();
		return redirect()->route('users.index')->with('success', 'User deleted successfully');
	}

	public function download(Request $request) {
		(new UsersExport)->store('users.csv', 'excel');
		return 'Export started!';
	}

/*
	public function ajaxGetHospByProv(Request $request) {
		$this->result = parent::hospitalByProv($request->prov_id);
		$htm = "<option value=\"0\">-- โปรดเลือก --</option>\n";
		foreach($this->result as $key=>$value) {
				$htm .= "<option value=\"".$value->hospcode."\">".$value->hosp_name."</option>\n";
		}
		return $htm;
	}
*/

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

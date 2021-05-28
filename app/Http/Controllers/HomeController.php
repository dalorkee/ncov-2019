<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB, Log, Session;
use App\User;
use App\Traits\BoundaryTrait;

class HomeController extends Controller
{
	use BoundaryTrait;

	public function __construct() {
		$this->middleware('auth');
		$this->middleware('onlyOneUser');
		$this->middleware(['role:root|ddc|dpc|pho|hos']);
	}

	public function index() {
		try {
			$user = Auth::user();
			$roleArr = $user->getRoleNames()->toArray();
			if (count($roleArr) > 0) {
				$user_role = $roleArr[0];
				Session::put('user_role', $roleArr[0]);
				$user_permissions = $user->permissions;
				if ($user_permissions->count() > 0) {
					foreach ($user_permissions as $key => $val) {
						$user->revokePermissionTo($val->name);
					}
				}
				//\DB::beginTransaction();
				switch ($user_role) {
					case "root":
						$user->syncPermissions([
							'permission-edit',
							'permission-delete',
							'permission-create',
							'role-create',
							'role-edit',
							'role-delete',
							'new-pui-create',
							'pui-delete',
							'pui-create',
							'pui-edit',
							'user-create',
							'user-edit',
							'user-delete'
						]);
						return redirect()->route('main');
						break;
					case "ddc":
					case "dpc":
					case "pho":
					case "hos":
						$user->syncPermissions([
							'new-pui-create',
							'pui-delete',
							'pui-create',
							'pui-edit'
						]);
						return redirect()->route('main');
						break;
					case "lab":
						return abort(404);
						break;
					default:
						return redirect()->route('logout');
						break;
				}
				//\DB::commit();
			} else {
				return redirect()->route('logout');
			}
		} catch (\Exception $e) {
			Log::error($e->getMessage());
			//\DB::rollback();
		}
	}

	public function mainPage() {
		return view('home');
	}

}

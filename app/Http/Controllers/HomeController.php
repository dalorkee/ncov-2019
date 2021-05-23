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
		$roleArr = auth()->user()->getRoleNames()->toArray();
		if (count($roleArr) > 0) {
			$user_role = $roleArr[0];
			Session::put('user_role', $roleArr[0]);
			$user = Auth::user();
			$this_permissions = DB::table('model_has_permissions')->select('permission_id')->where('model_id', $user->id)->get();
			$permissions = $user->getAllPermissions();
			$permissions->each(function($item, $key) use ($this_permissions, $user) {
				if ($this_permissions->where('permission_id', $item->id)) {
					$user->revokePermissionTo($item->name);
				}
			});
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
					$user->syncPermissions([
						'new-pui-create',
						'pui-delete',
						'pui-create',
						'pui-edit'
					]);
					return redirect()->route('main');
					break;
				case "dpc":
					$user->syncPermissions([
						'new-pui-create',
						'pui-delete',
						'pui-create',
						'pui-edit'
					]);
					return redirect()->route('main');
					break;
				case "pho":
					$user->syncPermissions([
						'new-pui-create',
						'pui-delete',
						'pui-create',
						'pui-edit'
					]);
					return redirect()->route('main');
					break;
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
		} else {
			return redirect()->route('logout');
		}
	}

	public function mainPage() {
		return view('home');
	}

}

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
			//DB::beginTransaction();
			$roleArr = auth()->user()->getRoleNames()->toArray();
			if (count($roleArr) > 0) {
				$user_role = $roleArr[0];
				Session::put('user_role', $roleArr[0]);
				$user = Auth::user();
				$user_permissions = $user->permissions;
				$db_permissions = Permission::all()->keyBy('id');
				$db_permissions->each(function($item, $key) use ($user, $user_permissions) {
					$x = $user_permissions->where('id', $item->id);
					if ($x->count() > 0) {
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
				//DB::commit();
			} else {
				return redirect()->route('logout');
			}
		} catch (\Exception $e) {
			Log::error($e->getMessage());
			//DB::rollBack();
		}
	}

	public function mainPage() {
		return view('home');
	}

}

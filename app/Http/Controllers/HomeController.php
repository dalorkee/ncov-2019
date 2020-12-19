<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Session;
use App\User;

class HomeController extends Controller
{
	public function __construct() {
		$this->middleware('auth');
		$this->middleware('onlyOneUser');
		$this->middleware(['role:root|ddc|dpc|pho|hos']);
	}

	public function index() {
		echo 'ok home';
		exit;
		$roleArr = auth()->user()->getRoleNames()->toArray();
		if (count($roleArr) > 0) {
			$user_role = $roleArr[0];
			Session::put('user_role', $roleArr[0]);
			$user = auth()->user();
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
						'pui-edit'
					]);
					return redirect()->route('list-data.invest');
					break;
				case "ddc":
					$user->syncPermissions([
						'new-pui-create',
						'pui-delete',
						'pui-create',
						'pui-edit'
					]);
					return redirect()->route('list-data.invest');
					break;
				case "dpc":
					$user->syncPermissions([
						'new-pui-create',
						'pui-delete',
						'pui-create',
						'pui-edit'
					]);
					return redirect()->route('list-data.invest');
					break;
				case "pho":
					$user->syncPermissions([
						'new-pui-create',
						'pui-delete',
						'pui-create',
						'pui-edit'
					]);
					return redirect()->route('list-data.invest');
					break;
				case "hos":
					$user->syncPermissions([
						'new-pui-create',
						'pui-delete',
						'pui-create',
						'pui-edit'
					]);
					return redirect()->route('list-data.invest');
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
}

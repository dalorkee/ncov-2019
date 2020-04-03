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
		//$this->middleware('chkUserRole');
		$this->middleware(['role:root|ddc|dpc|pho|hos']);
	}

	public function index() {
		$roleArr = auth()->user()->getRoleNames()->toArray();
		if (count($roleArr) > 0) {
			$user_role = $roleArr[0];
			Session::put('user_role', $roleArr[0]);
			switch ($user_role) {
				case "root":
					return redirect()->route('list-data.invest');
					break;
				case "ddc":
					return redirect()->route('list-data.invest');
					break;
				case "dpc":
					return redirect()->route('list-data.invest');
					break;
				case "pho":
					return redirect()->route('list-data.invest');
					break;
				case "hos":
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

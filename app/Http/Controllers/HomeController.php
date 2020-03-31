<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Session;

class HomeController extends Controller
{
	public function __construct() {
		$this->middleware('auth');
		//$this->middleware(['role:admin|hospital|lab']);
		//$this->middleware(['page_session']);

	}

	public function index()
	{
		$roleArr = auth()->user()->getRoleNames();

		if(count($roleArr) > 0) {

			$userRole = $roleArr[0];
			Session::put('user_role', $roleArr[0]);
			switch ($userRole) {
		    case "root":
		        return redirect()->route('list-data.sat');
		        break;
		    case "ddc":
		        return redirect()->route('list-data.sat');
		        break;
		    case "dpc":
		        return redirect()->route('list-data.sat');
		        break;
				case "pho":
				    return redirect()->route('list-data.sat');
				    break;
				case "hos":
						return redirect()->route('list-data.invest');
						break;
				case "lab":
				return abort(404);
						break;
		    default:
		        return redirect()->route('logout');
			}
		} else {
			//Session::put('user_role', 'unrole');
			return redirect()->route('logout');
		}
	}
}

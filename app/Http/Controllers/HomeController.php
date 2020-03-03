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
		if(isset($roleArr)){
			Session::put('user_role', 'admin@talek');
		}else{
			Session::put('user_role', '-');
		}

		//dd(Auth::user());

		return redirect()->route('list-data.sat');
	}

}

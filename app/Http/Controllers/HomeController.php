<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Session;

class HomeController extends MasterController
{
	/**
	* Create a new controller instance.
	*
	* @return void
	*/
	public function __construct()
	{
		$this->middleware('auth');
		$this->middleware(['role:admin|hospital|lab']);
		//$this->middleware(['permission:manageuser']);
		$this->middleware('page_session');

	}

	/**
	* Show the application dashboard.
	*
	* @return \Illuminate\Contracts\Support\Renderable
	*/
	public function index(Request $request)
	{
		/* router by permission */
		$roleArr = auth()->user()->roles->pluck('name');
		$userRole = $roleArr[0];
		if ($userRole == 'admin') {
			return redirect()->route('dashboard.index');
		} else {
			return redirect()->route('logout');
		}
	}

}

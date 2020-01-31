<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Auth;
//use Spatie\Permission\Models\Role;

use Session;

class HomeController extends Controller
{
	/**
	* Create a new controller instance.
	*
	* @return void
	*/

	/**
	* Show the application dashboard.
	*
	* @return \Illuminate\Contracts\Support\Renderable
	*/
	public function index()
	{
		//return redirect()->route('investList.index');
		return view('home');
	}

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DdcAuth;

class DdcAuthController extends Controller
{
	public function index(Request $request)
	{
		echo $request->id;
		
		$ddc_user_session_id = session()->get('id');
		$chk_ddc_user = DdcAuth::where('id', '=', $ddc_user_session_id)->get()->toArray();
		var_dump($chk_ddc_user);

		dd(session()->all());
	}

	public function create()
	{
		//
	}

	public function store(Request $request)
	{
		//
	}


	public function show(DdcAuth $ddcAuth)
	{
		//
	}

	public function edit(DdcAuth $ddcAuth)
	{
		//
	}

	public function update(Request $request, DdcAuth $ddcAuth)
	{
		//
	}

	public function destroy(DdcAuth $ddcAuth)
	{
		//
	}
}
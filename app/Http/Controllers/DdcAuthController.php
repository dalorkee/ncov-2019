<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DdcAuth;

class DdcAuthController extends Controller
{
	public function index(Request $request)
	{
		$chk_ddc_user = DdcAuth::where('id', '=', $request->id)->get()->toArray();
		dd($chk_ddc_user);
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

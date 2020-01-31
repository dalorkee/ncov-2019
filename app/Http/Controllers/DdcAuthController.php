<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DdcAuth;


class DdcAuthController extends Controller
{
	public function index(Request $request)
	{

		//$chk_ddc_user = DdcAuth::where('id', '=', $request->id)->get()->toArray();
		$chk_ddc_user = DdcAuth::where('id', '=', 1)->get()->toArray();
		if (count($chk_ddc_user) > 0) {
			$ddc_user = ['id' => $chk_ddc_user[0]['id'], 'list' => $chk_ddc_user[0]['list']];
			$request->session()->put('ddc_user', $ddc_user);
			return $request;
			//return redirect()->route('investList.index');
		} else {
			return false;
			//return Redirect::to('http://viral.ddc.moph.go.th/viral/index.php');
		}
	}

	public function ddcPermission($user_list_id=null) {

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

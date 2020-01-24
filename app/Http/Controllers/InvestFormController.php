<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\TitleName;
use App\Provinces;

class InvestFormController extends Controller
{

	public function index()
	{
		//
	}
	public function create()
	{
		$titleName = TitleName::all()->toArray();
		$provinces = Provinces::all()->toArray();
		return view('form.invest',
			[
				'titleName'=>$titleName,
				'provinces'=>$provinces
			]
		);
	}

	public function store(Request $request)
	{
		//
	}

	public function show($id)
	{
		//
	}

	public function edit($id)
	{
		//
	}

	public function update(Request $request, $id)
	{

	}

	public function destroy($id)
	{

	}
}

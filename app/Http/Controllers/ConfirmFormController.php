<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\TitleName;
use App\Provinces;
use App\InvestList;
use App\Occupation;

class ConfirmFormController extends Controller
{

	public function index()
	{
		//
	}

	public function create(Request $request)
	{
		$invest_pt = InvestList::where('poe_id', '=', $request->id)->get()->toArray();
		$titleName = TitleName::all()->toArray();
		$provinces = Provinces::all()->toArray();
		$occupation = Occupation::all()->keyBy('id')->toArray();

		return view('form.confirm.index',
			[
				'invest_pt' => $invest_pt,
				'titleName' => $titleName,
				'provinces' => $provinces,
				'occupation' => $occupation
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

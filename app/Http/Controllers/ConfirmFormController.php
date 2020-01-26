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
		$invest_pt = InvestList::where('sat_id', '=', $request->sat_id)->get()->toArray();
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

	public function addConfirmCase(Request $request)
	{
		$pt = InvestList::find($request->pod_id);
		$pt->pt_id = $request->pt_id;
		dd($pt);
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

	public function districtByProv($prov_code=0) {
		return DB::connection('mysql')
			->table('ref_district')
			->where('province_id', '=', $prov_code)
			->orderBy('district_id', 'asc')
			->get();
	}

	public function subDistrictByDistrict($dist_code=0) {
		return DB::connection('mysql')
			->table('ref_sub_district')
			->where('district_id', '=', $dist_code)
			->orderBy('sub_district_id', 'asc')
			->get();
	}

	public function districtFetch(Request $request) {
		$coll = self::districtByProv($request->id);
		$districts = $coll->keyBy('district_id');
		$htm = "<option value=\"0\">-- โปรดเลือก --</option>";
		foreach ($districts as $key => $val) {
			$htm .= "<option value=\"".$val->district_id."\">".$val->district_name."</option>";
		}
		return $htm;
	}

	public function subDistrictFetch(Request $request) {
		$coll = self::subDistrictByDistrict($request->id);
		$sub_districts = $coll->keyBy('sub_district_id');
		$htm = "<option value=\"0\">-- โปรดเลือก --</option>";
		foreach ($sub_districts as $key => $val) {
			$htm .= "<option value=\"".$val->sub_district_id."\">".$val->sub_district_name."</option>";
		}
		return $htm;
	}
}

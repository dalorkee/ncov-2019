<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\InvestSearch;
use App\Traits\BoundaryTrait;
use App\Traits\StringTrait;

class InvestSearchController extends Controller
{
	use BoundaryTrait;
	use StringTrait;

	public function __construct() {
		$this->middleware('auth');
		$this->middleware('onlyOneUser');
		$this->middleware(['role:root|ddc|dpc|pho|hos|lab']);
	}

	public function index(Request $request) {
		try {
			$user = Auth::user();
			$user_hosp = $user->hospcode;
			$user_prov = $user->prov_code;
			$user_zone_id = self::getZoneIdFromProvince($user->prov_code);
			$user_role = $user->roles->pluck('name')->all();
			$search =  $request->input('str_search');
			switch ($user_role[0]) {
				case 'root':
					if (strlen($search) <= 0) {
						$data = InvestSearch::select('id', 'sat_id', 'first_name', 'mid_name', 'last_name')->orderBy('id', 'ASC')->paginate(15);
					} else {
						$data = InvestSearch::select('id', 'sat_id', 'first_name', 'mid_name', 'last_name')->where('sat_id', 'like', '%'.$search.'%')->orderBy('id', 'ASC')->paginate(15);
						$data->appends(['str_search' => $search]);
					}
					break;
				case 'ddc':
					if (strlen($search) <= 0) {
						$data = InvestSearch::select('id', 'sat_id', 'first_name', 'mid_name', 'last_name')->orderBy('id', 'ASC')->paginate(15);
					} else {
						$data = InvestSearch::select('id', 'sat_id', 'first_name', 'mid_name', 'last_name')->where('sat_id', 'like', '%'.$search.'%')->orderBy('id', 'ASC')->paginate(15);
						$data->appends(['str_search' => $search]);
					}
					break;
				case 'dpc':
					$prov_arr = self::getProvCodeByRegion($user_zone_id);
					$prov_str = self::arrayToString($prov_arr);
					if (strlen($search) <= 0) {
						$data = InvestSearch::select('id', 'sat_id', 'first_name', 'mid_name', 'last_name')
						->whereRaw("(isolated_province IN(".$prov_str.") OR walkinplace_hosp_province IN(".$prov_str.") OR sick_province_first IN(".$prov_str.") OR treat_place_province IN(".$prov_str."))")
						->orderBy('id', 'ASC')->paginate(15);
					} else {
						$data = InvestSearch::select('id', 'sat_id', 'first_name', 'mid_name', 'last_name')->where('sat_id', 'like', '%'.$search.'%')
						->whereRaw("(isolated_province IN(".$prov_str.") OR walkinplace_hosp_province IN(".$prov_str.") OR sick_province_first IN(".$prov_str.") OR treat_place_province IN(".$prov_str."))")
						->orderBy('id', 'ASC')->paginate(15);
						$data->appends(['str_search' => $search]);
					}
					break;
				case 'pho':
					if (strlen($search) <= 0) {
						$data = InvestSearch::select('id', 'sat_id', 'first_name', 'mid_name', 'last_name')
						->whereRaw('(isolated_province = '.$user_prov.' OR walkinplace_hosp_province = '.$user_prov.' OR sick_province_first = '.$user_prov.' OR treat_place_province = '.$user_prov.')')
						->orderBy('id', 'ASC')->paginate(15);
					} else {
						$data = InvestSearch::select('id', 'sat_id', 'first_name', 'mid_name', 'last_name')->where('sat_id', 'like', '%'.$search.'%')
						->whereRaw('(isolated_province = '.$user_prov.' OR walkinplace_hosp_province = '.$user_prov.' OR sick_province_first = '.$user_prov.' OR treat_place_province = '.$user_prov.')')
						->orderBy('id', 'ASC')->paginate(15);
						$data->appends(['str_search' => $search]);
					}
					break;
				case 'hos':
					if (strlen($search) <= 0) {
						$data = InvestSearch::select('id', 'sat_id', 'first_name', 'mid_name', 'last_name')
						->whereRaw('(isolated_hosp_code = '.$user_hosp.' OR walkinplace_hosp_code = '.$user_hosp.' OR treat_first_hospital = '.$user_hosp. ' OR treat_place_hospital = '.$user_hosp.')')
						->orderBy('id', 'ASC')->paginate(15);
					} else {
						$data = InvestSearch::select('id', 'sat_id', 'first_name', 'mid_name', 'last_name')->where('sat_id', 'like', '%'.$search.'%')
						->whereRaw('(isolated_hosp_code = '.$user_hosp.' OR walkinplace_hosp_code = '.$user_hosp.' OR treat_first_hospital = '.$user_hosp. ' OR treat_place_hospital = '.$user_hosp.')')
						->orderBy('id', 'ASC')->paginate(15);
						$data->appends(['str_search' => $search]);
					}
					break;
				default:
					return redirect()->route('/logout');
					break;
			}
			//return View('list-data.search')->with('data', $data);
			return view('list-data.search', compact('data'))->with('i', ($request->input('page', 1) - 1) * 10);
		} catch (Exception $e) {
			Log::error($e->getMessage());
		}
	}

	/*
	public function search(Request $request) {
		try {
			$input = $request->all();
			$str = trim($input['str_search']);
			if (strlen($str) > 0) {
				$data = InvestSearch::select(
					'id',
					'sat_id',
					'first_name',
					'mid_name',
					'last_name')
				->where('sat_id', 'like', '%'.strtoupper($str).'%')
				->orderBy('id', 'ASC')->paginate(3);
				return view('list-data.search', compact('data'))->with('i', ($request->input('page', 1) - 1) * 3);
			} else {
				return redirect()->route('list-data.search')->with('error', 'โปรดกรอกข้อมูลที่ต้องการค้นหา!!');
			}
		} catch (Exception $e) {
			Log::error($e->getMessage());
		}
	}
	*/
}

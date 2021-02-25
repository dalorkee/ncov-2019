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

			$condition_method =  $request->condition_method ?? '0';
			$search =  $request->str_search ?? null;

			if ($condition_method == '0') {
				switch ($user_role[0]) {
					case 'root':
					case 'ddc':
						$data = InvestSearch::select('id', 'sat_id', 'passport', 'first_name', 'mid_name', 'last_name')->orderBy('id', 'DESC')->paginate(15);
						break;
					case 'dpc':
						$prov_arr = self::getProvCodeByRegion($user_zone_id);
						$prov_str = self::arrayToString($prov_arr);
						$data = InvestSearch::select('id', 'sat_id', 'passport', 'first_name', 'mid_name', 'last_name')
							->whereRaw("(isolated_province IN(".$prov_str.") OR walkinplace_hosp_province IN(".$prov_str.") OR sick_province_first IN(".$prov_str.") OR treat_place_province IN(".$prov_str."))")
							->orderBy('id', 'DESC')->paginate(15);
						break;
					case 'pho':
						$data = InvestSearch::select('id', 'sat_id', 'passport', 'first_name', 'mid_name', 'last_name')
							->whereRaw('(isolated_province = '.$user_prov.' OR walkinplace_hosp_province = '.$user_prov.' OR sick_province_first = '.$user_prov.' OR treat_place_province = '.$user_prov.')')
							->orderBy('id', 'DESC')->paginate(15);
						break;
					case 'hos':
						$data = InvestSearch::select('id', 'passport', 'sat_id', 'first_name', 'mid_name', 'last_name')
							->whereRaw('(isolated_hosp_code = '.$user_hosp.' OR walkinplace_hosp_code = '.$user_hosp.' OR treat_first_hospital = '.$user_hosp. ' OR treat_place_hospital = '.$user_hosp.')')
							->orderBy('id', 'DESC')->paginate(15);
						break;
					default:
						return redirect()->route('logout');
						break;
				}
				return view('list-data.search', compact('data'))->with('i', ($request->input('page', 1) - 1) * 10);
			} elseif ($condition_method == '1' || $condition_method == '2') {
				if (strlen($search) <= 0) {
					return redirect()->back()->with('warning', 'โปรดกรอกข้อความที่ต้องการค้นหา');
				} else {
					switch ($condition_method) {
						case '1':
							$field_name = 'sat_id';
							break;
						case '2':
							$field_name = 'passport';
							break;
						default:
							return redirect()->route('logout');
							break;
					}
					switch ($user_role[0]) {
						case 'root':
						case 'ddc':
							$data = InvestSearch::select('id', 'sat_id', 'passport', 'first_name', 'mid_name', 'last_name')->where($field_name, 'like', '%'.$search.'%')->orderBy('id', 'DESC')->paginate(15);
							$data->appends(['str_search' => $search]);
							break;
						case 'dpc':
							$prov_arr = self::getProvCodeByRegion($user_zone_id);
							$prov_str = self::arrayToString($prov_arr);
							$data = InvestSearch::select('id', 'sat_id', 'passport', 'first_name', 'mid_name', 'last_name')->where($field_name, 'like', '%'.$search.'%')
								->whereRaw("(isolated_province IN(".$prov_str.") OR walkinplace_hosp_province IN(".$prov_str.") OR sick_province_first IN(".$prov_str.") OR treat_place_province IN(".$prov_str."))")
								->orderBy('id', 'DESC')->paginate(15);
							$data->appends(['str_search' => $search]);
							break;
						case 'pho':
							$data = InvestSearch::select('id', 'sat_id', 'passport', 'first_name', 'mid_name', 'last_name')->where($field_name, 'like', '%'.$search.'%')
								->whereRaw('(isolated_province = '.$user_prov.' OR walkinplace_hosp_province = '.$user_prov.' OR sick_province_first = '.$user_prov.' OR treat_place_province = '.$user_prov.')')
								->orderBy('id', 'DESC')->paginate(15);
							$data->appends(['str_search' => $search]);
							break;
						case 'hos':
							$data = InvestSearch::select('id', 'sat_id', 'passport', 'first_name', 'mid_name', 'last_name')->where($field_name, 'like', '%'.$search.'%')
								->whereRaw('(isolated_hosp_code = '.$user_hosp.' OR walkinplace_hosp_code = '.$user_hosp.' OR treat_first_hospital = '.$user_hosp. ' OR treat_place_hospital = '.$user_hosp.')')
								->orderBy('id', 'DESC')->paginate(15);
							$data->appends(['str_search' => $search]);
							break;
						default:
							return redirect()->route('logout');
							break;
					}
					return view('list-data.search', compact('data'))->with('i', ($request->input('page', 1) - 1) * 10);
				}
			}
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

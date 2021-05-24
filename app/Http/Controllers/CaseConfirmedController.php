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
use App\CaseConfirmed;
use App\Traits\BoundaryTrait;
use App\Traits\StringTrait;

class CaseConfirmedController extends Controller
{
	use BoundaryTrait, StringTrait;

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
					case 'dpc':
					case 'pho':
					case 'hos':
						$data = CaseConfirmed::select('id', 'sat_id', 'passport', 'pt_status', 'first_name', 'mid_name', 'last_name')
							->wherePt_status('2')
							->orderBy('id', 'DESC')
							->paginate(15);
						break;
					default:
						return redirect()->route('logout');
						break;
				}
				return view('list-data.confirmed', compact('data'))->with('i', ($request->input('page', 1) - 1) * 10);
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
						case 'dpc':
						case 'pho':
						case 'hos':
							$data = CaseConfirmed::select('id', 'sat_id', 'passport', 'pt_status', 'first_name', 'mid_name', 'last_name')
								->wherePt_status('2')
								->where($field_name, 'like', '%'.$search.'%')
								->orderBy('id', 'DESC')
								->paginate(15);
							$data->appends(['str_search' => $search]);
							break;
						default:
							return redirect()->route('logout');
							break;
					}
					return view('list-data.confirmed', compact('data'))->with('i', ($request->input('page', 1) - 1) * 10);
				}
			}
		} catch (Exception $e) {
			Log::error($e->getMessage());
		}
	}
}

<?php
namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Hospitals;
use App\District;
use App\SubDistrict;

trait BoundaryTrait {
	public function getGlobalCountry() : array {
		try {
			if (Storage::disk('json')->exists('ref_global_country.json')) {
				$data = json_decode(Storage::disk('json')->get('ref_global_country.json'), true);
				return $data;
			} else {
				return array();
			}
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	public function getProvince() : array {
		try {
			if (Storage::disk('json')->exists('ref_province.json')) {
				$data = json_decode(Storage::disk('json')->get('ref_province.json'), true);
				return $data;
			} else {
				return array();
			}
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	public function getMinProvince() : array {
		try {
			$provinces = self::getProvince();
			foreach ($provinces as $key => $val) {
				$minProvince[$key] = $val['province_name'];
			}
			return $minProvince;
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	public function getProvCodeByRegion($region=4) {
		try {
			if (Storage::disk('json')->exists('ref_province.json')) {
				$data = json_decode(Storage::disk('json')->get('ref_province.json'), true);
				$data = collect($data);
				$data = $data->where('zone_id', $region);
				$result = $data->pluck('province_id')->toArray();
				return $result;
			} else {
				return array();
			}
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	public function getDistrictByProvince($prov_id) : object {
		try {
			if (Storage::disk('json')->exists('ref_district.json')) {
				$data = json_decode(Storage::disk('json')->get('ref_district.json'), true);
				$data = collect($data);
				$result = $data->where('province_id', $prov_id);
				$result->all();
				return $result;
			} else {
				return collect();
			}
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	public function renderDistrictToHtmlSelect(Request $request) : string {
		try {
			$district = self::getDistrictByProvince($request->id);
			$htm = "<option value=\"\">-- โปรดเลือก --</option>";
			foreach ($district as $key => $val) {
				$htm .= "<option value=\"".$key."\">".$val['district_name']."</option>";
			}
			return $htm;
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	public function getSubDistrictByDistrict($district_id) : object {
		try {
			if (Storage::disk('json')->exists('ref_sub_district.json')) {
				$data = json_decode(Storage::disk('json')->get('ref_sub_district.json'), true);
				$data = collect($data);
				$result = $data->where('district_id', $district_id);
				$result->all();
				return $result;
			} else {
				return collect();
			}
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	public function renderSubDistrictToHtmlSelect(Request $request) : string {
		try {
			$sub_district = self::getSubDistrictByDistrict($request->id);
			$htm = "<option value=\"\">-- โปรดเลือก --</option>";
			foreach ($sub_district as $key => $val) {
				$htm .= "<option value=\"".$key."\">".$val['sub_district_name']."</option>";
			}
			return $htm;
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	public function getHospByProvince($prov_id) : object {
		try {
			$json_file_name = 'hosp_prov_'.$prov_id.'.json';
			if (Storage::disk('json')->exists($json_file_name)) {
				$data = json_decode(Storage::disk('json')->get($json_file_name), true);
				$result = collect($data);
				return $result;
			} else {
				return collect();
			}
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	public function renderHospToHtmlSelect(Request $request) : string {
		try {
			$hosp = self::getHospByProvince($request->idx);
			$htm = "<option value=\"\">-- โปรดเลือก --</option>";
			foreach ($hosp as $key => $val) {
				$htm .= "<option value=\"".$val['hospcode']."\">".$val['hosp_name']."</option>";
			}
			return $htm;
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	public function getHospDetailByHospCode($hospcode=0) : ?object {
		$result = Hospitals::where('hospcode', (int)$hospcode)->first();
		return $result;
	}

	public function getDistrictDetailByDistrictId($dist_id=0) : ?object {
		$result = District::where('district_id', (int)$dist_id)->get();
		return $result;
	}

	public function getSubDistrictDetailBySubDistrictId($sub_dist_id=0) : ?object {
		$result = SubDistrict::where('sub_district_id', (int)$sub_dist_id)->get();
		return $result;
	}

	public function getHospitalDetailByHospCode($hospcode=0) : ?object {
		$hosp = Hospitals::where('hospcode', (int)$hospcode)->get();
		return $hosp;
	}

	public function getHospNameByHospCode($hospcode=0) : array {
		$hosp = Hospitals::select('hospcode', 'hosp_name')->where('hospcode', (int)$hospcode)->first()->toArray();
		$result[$hosp['hospcode']] = $hosp['hosp_name'];
		return $result;
	}

	/* for generate json only  */

	/*
	public function dbToJson() {
		$data = GlobalCountry::all()->keyBy('country_id')->toJson();
		Storage::disk('json')->put('ref_global_country.json', $data);
	}
	*/

	/*
	public function queryToJson() {
		$x = Hospitals::select('prov_code')->get()->keyBy('prov_code')->toArray();
		foreach ($x as $key => $value) {
			$y = Hospitals::select('hospcode', 'hosp_name', 'hosp_type_code', 'status_code', 'prov_code', 'ampur_code', 'tambol_code', 'phone', 'region')->where('prov_code', $key)->get()->toJson();
			$n = 'hosp_prov_'.$key.'.json';
			Storage::disk('json')->put($n, $y);
		}
	}
	*/
}
?>

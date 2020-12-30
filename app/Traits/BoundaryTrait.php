<?php
namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

trait BoundaryTrait {
	public function getProvince(): array {
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

	public function getDistrictByProvince($prov_id): object {
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

	public function renderDistrictToHtmlSelect(Request $request): string {
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

	public function getSubDistrictByDistrict($district_id): object {
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

	public function renderSubDistrictToHtmlSelect(Request $request): string {
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

	public function getHospByProvince($prov_id): object {
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

	public function renderHospToHtmlSelect(Request $request): string {
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

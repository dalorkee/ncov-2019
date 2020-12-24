<?php
namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

trait ProvinceTrait {
	public function getProvince() {
		try {
			if (Storage::disk('json')->exists('ref_province.json')) {
				$jsonStr = file_get_contents(Storage::disk('json')->get('ref_province.json'));
				$data = json_decode($jsonStr, true, JSON_THROW_ON_ERROR);
				var_dump($data);
			}
		} catch (Exception $e) {
			echo $e->getMessage();
		}
		//return Province::all()->sortBy('province_name')->keyBy('province_id')->toArray();
	}

/*
	public function getDistrictByProvince($prov_id): array {
		$result = District::where('province_id', $prov_id)->get();
		$result = $result->sortBy('district_name')->keyBy('district_id')->toArray();
		return $result;
	}

	public function getSubDistrictByDistrict($district_id): array {
		$result = SubDistrict::where('district_id', $district_id)->get();
		$result = $result->sortBy('sub_district_name')->keyBy('sub_district_id')->toArray();
		return $result;
	}

	public function getDistrictToHtmlSelect(Request $request): string {
		$district = self::getDistrictByProvince($request->id);
		$htm = "<option value=\"\">-- โปรดเลือก --</option>";
		foreach ($district as $key => $val) {
			$htm .= "<option value=\"".$key."\">".$val['district_name']."</option>";
		}
		return $htm;
	}

	public function getSubDistrictToHtmlSelect(Request $request): string {
		$sub_district = self::getSubDistrictByDistrict($request->id);
		$htm = "<option value=\"\">-- โปรดเลือก --</option>";
		foreach ($sub_district as $key => $val) {
			$htm .= "<option value=\"".$key."\">".$val['sub_district_name']."</option>";
		}
		return $htm;
	}
*/
}
?>

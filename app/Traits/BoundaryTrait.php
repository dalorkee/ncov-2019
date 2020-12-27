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
				return null;
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
				return null;
			}
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	public function getSubDistrictByDistrict($district_id): array {
		try {
			if (Storage::disk('json')->exists('ref_sub_district.json')) {
				$data = json_decode(Storage::disk('json')->get('ref_sub_district.json'), true);
				return $data;
			} else {
				return null;
			}
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	public function renderDistrictToHtmlSelect(Request $request): string {
		$district = self::getDistrictByProvince($request->id);
		$htm = "<option value=\"\">-- โปรดเลือก --</option>";
		foreach ($district as $key => $val) {
			$htm .= "<option value=\"".$key."\">".$val['district_name']."</option>";
		}
		return $htm;
	}

/*
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

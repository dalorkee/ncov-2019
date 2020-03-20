<?php

namespace App\Exports;

use App\InvestList;
use App\Provinces;
use App\Occupation;
use App\GlobalCountry;
use App\Hospitals;
use Maatwebsite\Excel\Concerns\FromCollection;

class InvestExport implements FromCollection
{
	public function collection() {
		//return collect([1=>[1], 2=>[2], 3=>[3]]);
		$prov = Provinces::all()->keyBy('province_id')->toArray();
		$occu = Occupation::all()->keyBy('id')->toArray();
		$globalCountry = GlobalCountry::all()->keyBy('country_id')->toArray();
		$hospitals = Hospitals::all()->keyBy('hospcode');
		$data = InvestList::select(
			'first_name',
			'last_name',
			'sex',
			'age',
			'isolated_province',
			'occupation',
			'order_pt',
			'nation',
			'walkinplace_hosp_code',
			'walkinplace_hosp_province'
		)->where('id', '<=', 10)->get()->toArray();

		$result = collect();

		foreach($data as $key => $val) {
			if (!empty($val['isolated_province']) || $val['isolated_province'] != NULL) {
				$province = $prov[$val['isolated_province']]['province_name'];
			} else {
				$province = '-';
			}

			if (!empty($val['occupation']) || $val['occupation'] != NULL) {
				$occ = $occu[$val['occupation']]['occu_name_th'];
			} else {
				$occ = '-';
			}

			if (!empty($val['nation']) || $val['nation'] != NULL) {
				$nation = $globalCountry[$val['nation']]['country_name'];
			} else {
				$nation = '-';
			}

			if (!empty($val['walkinplace_hosp_code']) || $val['walkinplace_hosp_code'] != NULL) {
				$walk_hosp = $hospitals[$val['walkinplace_hosp_code']]['hosp_name'];
			} else {
				$walk_hosp= '-';
			}

			if (!empty($val['walkinplace_hosp_province']) || $val['walkinplace_hosp_province'] != NULL) {
				$walk_prov = $prov[$val['walkinplace_hosp_province']]['province_name'];
			} else {
				$walk_prov= '-';
			}

			$arr = array(
				'first_name' => $val['first_name'],
				'last_name' => $val['last_name'],
				'isolated_province' => $province,
				'occupation' => $occ,
				'order_no' => $val['order_pt'],
				'nation' => $nation,
				'walkinplace_hosp_code' => $walk_hosp,
				'walkinplace_hosp_province' => $walk_prov
			);

			$result->push($arr);
		}
		return $result;


		/*
			return collect([
				0 => [
					'first_name' => 'ดำดี',
					'last_name' => 'สีไม่ตก'
					],
				1 => [
					'first_name' => 'เอาละสิ',
					'last_name' => 'เอนเกม'
				]
			]);
			*/
	}

}

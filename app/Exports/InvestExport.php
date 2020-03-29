<?php

namespace App\Exports;

use App\InvestList;
use App\Provinces;
use App\Occupation;
use App\GlobalCountry;
use App\Hospitals;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class InvestExport implements FromCollection, WithHeadings
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
			'occupation',
			'occupation_oth',
			'order_pt',
			'nation',
			'walkinplace_hosp_code',
			'walkinplace_hosp_province',
			'isolated_hosp_code',
			'isolated_province'
		)
		->where('pt_status', '=', 2)
		->whereNull('deleted_at')->get()->toArray();
		$result = collect();
		foreach($data as $key => $val) {
			if (!empty($val['occupation']) || $val['occupation'] != null) {
				if ($val['occupation'] == 99) {
					$occ = $val['occupation_oth'];
				} else {
					$occ = $occu[$val['occupation']]['occu_name_th'];
				}
			} else {
				$occ = '-';
			}
			if (!empty($val['nation']) || $val['nation'] != null) {
				$nation = $globalCountry[$val['nation']]['country_name'];
			} else {
				$nation = '-';
			}
			if (!empty($val['walkinplace_hosp_code']) || $val['walkinplace_hosp_code'] != null) {
				$walk_hosp = $hospitals[$val['walkinplace_hosp_code']]['hosp_name'];
			} else {
				$walk_hosp= '-';
			}
			if (!empty($val['walkinplace_hosp_province']) || $val['walkinplace_hosp_province'] != null) {
				$walk_prov = $prov[$val['walkinplace_hosp_province']]['province_name'];
			} else {
				$walk_prov= '-';
			}
			if (!empty($val['isolated_hosp_code']) || $val['isolated_hosp_code'] != null) {
				$iso_hosp = $hospitals[$val['isolated_hosp_code']]['hosp_name'];
			} else {
				$iso_hosp= '-';
			}
			if (!empty($val['isolated_province']) || $val['isolated_province'] != null) {
				$iso_prov = $prov[$val['isolated_province']]['province_name'];
			} else {
				$iso_prov = '-';
			}
			$arr = array(
				'first_name' => $val['first_name'],
				'last_name' => $val['last_name'],
				'occupation' => $occ,
				'order_id' => $val['order_pt'],
				'nation' => $nation,
				'walkinplace_hosp_code' => $walk_hosp,
				'walkinplace_hosp_province' => $walk_prov,
				'isolated_hosp_code' => $iso_hosp,
				'isolated_province' => $iso_prov,
				'pt_status' => 'Confirmed'
			);
			$result->push($arr);
		}
		return $result;
	}

	public function headings(): array {
		return [
			'First name',
			'Last name',
			'Occupation',
			'Order ID',
			'Nation',
			'First hospital',
			'First hospital province',
			'Current hospital',
			'Current hospital province',
			'Status'
		];
	}

}

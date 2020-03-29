<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MasterController extends Controller
{
	public $result;

	public function __construct() {
		$this->result = null;
	}

	public function setStatus() {
		$status = collect([
			'pt_status' => [
				1 => 'PUI (รอผลแลป)',
				2 => 'Confirmed (ผลแลปยืนยัน)',
				3 => 'Probable',
				4 => 'Suspected',
				5 => 'Excluded (ผลแลปเป็นลบ)'
			],
			'news_st' => [
				1 => 'Confirmed publish',
				2 => 'Confirmed not yet released',
			],
			'disch_st' => [
				1 => 'Recovered',
				2 => 'Admitted',
				3 => 'Death',
				4 => 'Self quarantine'
			],
			'pui_type' => [
				1 => 'New PUI',
				2 => 'Contact PUI',
				3 => 'PUO',
				//4 => 'Confirmed nCoV-2019',
			],
			'screen_pt' => [
				1 => 'คัดกรองที่สนามบิน',
				2 => 'Walkin มาที่ รพ.',

			],
			'arrfollowup_address' => [
				1 => 'บ้าน',
				2 => 'โรงแรม',
				3 => 'โรงพยาบาล',
				4 => 'สถานที่กักกัน',
				5 => 'อื่นๆ'
			],
			'pt_treat_status' => [
				1 => 'หาย',
				2 => 'ยังรักษาอยู่',
				3 => 'เสียชีวิต',
				4 => 'ส่งต่อ',
				5 => 'อื่นๆ'
			],

		]);
		return $status;
	}

	public function getStatus() {
		$status = $this->setStatus();
		return $status;
	}

	private function setDrug() {
		$drug = collect([
			'covid-19' => [
				1 => 'Darunavir/Ritonavir (DRV/r)',
				2 => 'Lopinavir/Ritonavir (LPV/r)',
				3 => 'Favipiravir',
				4 => 'Chloroquine',
				5 => 'Hydroxychloroquine',
				6 => 'Oseltamivir',
				7 => 'Other'
			]
		]);
		return $drug;
	}

	protected function getDrug() {
		return $this->setDrug();
	}


}

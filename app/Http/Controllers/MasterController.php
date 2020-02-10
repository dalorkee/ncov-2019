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

	private function setStatus() {
		$status = collect([
			'pt_status' => [
				'1' => 'PUI',
				'2' => 'Confirmed',
				'3' => 'Probable',
				'4' => 'Suspected',
				'5' => 'Excluded'
			],
			'news_st' => [
				'1' => 'Confirmed publish',
				'2' => 'Confirmed not yet released',
			],
			'disch_st' => [
				'1' => 'Recovery',
				'2' => 'Admit',
				'3' => 'Death',
				'4' => 'Selt quarantine'
			],
			'pui_type' => [
				'1' => 'New PUI',
				'2' => 'Contact PUI',
				'3' => 'PUO',
				'4' => 'Confirmed nCoV-2019',
			],
			'screen_pt' => [
				'1' => 'คัดกรองที่สนามบิน',
				'2' => 'Walkin มาที่ รพ.',

			]
		]);
		return $status;
	}

	protected function getStatus() {
		$status = $this->setStatus();
		return $status;
	}


}

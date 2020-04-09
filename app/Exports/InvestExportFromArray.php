<?php

namespace App\Exports;

use App\Invest;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromArray;

class InvestExportFromArray implements FromArray {

	use Exportable;
	public $inputArr;

	public function __construct(array $inputArr = []) {
		$this->inputArr = $inputArr;
	}

	public function array() :array {
		if (count($this->inputArr) > 0) return $this->inputArr;
		return [];
	}
}

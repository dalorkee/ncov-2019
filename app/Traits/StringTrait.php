<?php
namespace App\Traits;

use Illuminate\Http\Request;

trait StringTrait {
	public function arrayToString($array=array()): ?string {
		$str = null;
		if (count($array) > 0) {
			foreach ($array as $key => $value) {
				if (is_null($str)) {
					$str = "";
				} else {
					$str = $str.",";
				}
				$str = $str.$value;
			}
		}
		return $str;
	}
}
?>

<?php
namespace App\Traits;

use Illuminate\Http\Request;

trait UserTrait {
	public function userGroup(): array {
		$userGroup = array(
			1 => 'กรมควบคุมโรค',
			3 => 'สคร',
			8 => 'สสจ',
			7 => 'โรงพยาบาล',
			2 => 'Laboratory'
		);
		return $userGroup;
	}
}
?>

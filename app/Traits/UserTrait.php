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

	public function userTitleName(): array {
		$titleName = array(
			1 => 'นาย',
			2 => 'นาง',
			3 => 'นางสาว',
			4 => 'ด.ช.',
			5 => 'ด.ญ.'
		);
		return $titleName;
	}
}
?>

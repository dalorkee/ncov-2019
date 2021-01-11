<?php
namespace App\Traits;

use Illuminate\Http\Request;

trait UserTrait {
	public function userGroup() : array {
		return [
			1 => 'กรมควบคุมโรค',
			3 => 'สคร',
			8 => 'สสจ',
			7 => 'โรงพยาบาล',
			2 => 'Laboratory'
		];
	}

	public function userTitleName() : array {
		return [
			1 => 'นาย',
			2 => 'นาง',
			3 => 'นางสาว',
			4 => 'ด.ช.',
			5 => 'ด.ญ.'
		];
	}

	public function directAllowCreateNewUserTo() : array {
		return  [
			'pjxja'
		];
	}

	public function mapUserGroupToUserRole() : array {
		return [
			-1 => 'root',
			1 => 'ddc',
			3 => 'dpc',
			8 => 'pho',
			7 => 'hos',
			2 => 'lab'
		];
	}
}
?>

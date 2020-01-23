<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MasterController extends Controller implements Master
{
	public $result;

	public function __construct() {
		$this->result = null;
	}

}

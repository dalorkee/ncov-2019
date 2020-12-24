<?php

namespace App\Http\Controllers;

use App\Test;
use Illuminate\Http\Request;
use App\Traits\ProvinceTrait;

class TestController extends Controller
{
	use ProvinceTrait;

	public function index() {
		self::getProvince();
	}

	public function create() {
		//
	}

	public function store(Request $request) {
		//
	}

	public function show(Test $test) {
		//
	}

	public function edit(Test $test) {
		//
	}

	public function update(Request $request, Test $test) {
		//
	}

	public function destroy(Test $test) {
		//
	}
}

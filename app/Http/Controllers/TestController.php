<?php

namespace App\Http\Controllers;

use App\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestController extends Controller
{

	public function index() {
		if (Storage::disk('sftp')->exists('pj.txt')) {
			echo 'ok';
		} else {
			echo 'nok';
		}
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

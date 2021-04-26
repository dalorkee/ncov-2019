<?php

namespace App\Http\Controllers;

use App\Hospitals;
use Illuminate\Http\Request;

class HospitalsController extends Controller
{
	public function index() {
		//
	}

	public function create() {
		$invest_pt=Hospitals::all()->toArray();
		return view("hospital.screen",
			["invest_pt"=>$invest_pt]
		);
	}

	public function store(Request $request) {
		//
	}

	public function show(Hospital $hospital) {
		//
	}

	public function edit(Hospital $hospital) {
		//
	}

	public function update(Request $request, Hospital $hospital) {
		//
	}

	public function destroy(Hospital $hospital) {
		//
	}
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ListData;
use DataTables;

class ListDataController extends Controller
{
	public function invest() {
		return view('list-data.invest');
	}

	public function investData(){
		return DataTables::of(ListData::query())->make(true);
	}
}

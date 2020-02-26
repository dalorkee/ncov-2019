<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\ListInvestDataTable;

class ListInvestController extends Controller
{
	public function index(ListInvestDataTable $dataTable) {
		$test = ['a'=>'aa'];
		return $dataTable->render('list-data.invest', compact('test'));
	}
}

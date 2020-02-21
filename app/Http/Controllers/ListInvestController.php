<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\ListInvestDataTable;

class ListInvestController extends Controller
{
	public function index(ListInvestDataTable $dataTable) {
		return $dataTable->render('list-data.invest');
	}
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\DataListDataTable;

class DataListController extends Controller
{
	public function index(DataListDataTable $dataTable) {
		return $dataTable->render('list-data.index');
	}
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\ListDataDataTable;

class ListDataController extends Controller
{
	public function index(UsersDataTable $dataTable) {
		return $dataTable->render('list-data.index');
	}
}

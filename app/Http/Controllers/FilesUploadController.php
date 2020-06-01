<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\ListFilesUploadDataTable;

class FilesUploadController extends Controller
{
	public function index(ListFilesUploadDataTable $dataTable) {
		return $dataTable->render('files.create');
	}
}

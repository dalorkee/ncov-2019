<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Exports\ContactExport;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromQuery;
class ExportContactController extends Controller
{
    public function export($id)
    {
         // $querytable = $this->querytable();
          // dd($this->querytable());
        // return (new $querytable)->download('invoices.xlsx');
          return Excel::download(new ContactExport($id), 'contactbysatid.xlsx');
    }


}

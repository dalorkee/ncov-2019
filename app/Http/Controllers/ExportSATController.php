<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Exports\SatExport;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromQuery;
class ExportSATController extends MasterController
{
    public function satexport(Request $req)
    {

      // dd($uid_prefix);
      if ($req->pt_status == null || empty($req->pt_status)) {
  			$new_status = ['1', '2', '3', '4', '5'];
  		} else {
  			$new_status = $req->pt_status;
  		}
      if (empty($req->created_at_s) || $req->created_at_s == null) {
        $created_at_s = Date('Y-m-d');
      } else {
        $created_at_s=$this->convertDateToMySQL($req ->input ('created_at_s'));
      }

      if (empty($req->created_at_e) || $req->created_at_e == null) {
        $created_at_e = Date('Y-m-d');
      } else {
        $created_at_e= $this->convertDateToMySQL($req ->input ('created_at_e'));
      }
      $data = array(
        // 'poe_id'=>$poe_id,
        'created_at_s'=>$created_at_s,
        'created_at_e'=>$created_at_e,
        'new_status'=>$new_status,
      );
      // dd($data);
      // return $data;

          return Excel::download(new SatExport($data), 'SATEXPORT.xlsx');
    }

    protected function convertDateToMySQL($date='00/00/0000') {
      if (!is_null($date) || !empty($date)) {
        $ep = explode("/", $date);
        $string = $ep[2]."-".$ep[1]."-".$ep[0];
      } else {
        $string = NULL;
      }
      return $string;
    }
}

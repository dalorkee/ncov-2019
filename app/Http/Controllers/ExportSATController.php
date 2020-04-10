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
      if (empty($req->created_at) || $req->created_at == null) {
        $created_at = Date('Y-m-d');
      } else {
        $created_at=$this->convertDateToMySQL($req ->input ('created_at'));
      }

      if (empty($req->notify_date_end) || $req->notify_date_end == null) {
        $notify_date_end = Date('Y-m-d');
      } else {
        $notify_date_end= $this->convertDateToMySQL($req ->input ('notify_date_end'));
      }
      $data = array(
        // 'poe_id'=>$poe_id,
        'notify_date_end'=>$notify_date_end,
        'created_at'=>$created_at,
        'new_status'=>$new_status,
      );
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

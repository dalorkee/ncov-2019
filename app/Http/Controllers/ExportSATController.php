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
      $uid = auth()->user()->id;
      if ($uid == 2 || $uid == 97 || $uid == 30 || $uid == 35 || $uid == 76) {

      if ($req->pt_status == null || empty($req->pt_status)) {
  			$new_status = ['1', '2', '3', '4', '5'];
  		} else {
  			$new_status = $req->pt_status;
  		}
      if (empty($req->notify_date) || $req->notify_date == null) {
        $notify_date = Date('Y-m-d');
      } else {
        $notify_date=$this->convertDateToMySQL($req ->input ('notify_date'));
      }

      if (empty($req->notify_date_end) || $req->notify_date_end == null) {
        $notify_date_end = Date('Y-m-d');
      } else {
        $notify_date_end= $this->convertDateToMySQL($req ->input ('notify_date_end'));
      }
      $data = array(
        // 'poe_id'=>$poe_id,
        'notify_date_end'=>$notify_date_end,
        'notify_date'=>$notify_date,
        'new_status'=>$new_status,
      );
      // return $data;

          return Excel::download(new SatExport($data), 'SATEXPORT.xlsx');
    }
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

<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Exports\ContactExportbyDay;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromQuery;
class ExportContactbyDayController extends Controller
{
    public function exportcontactbyday(Request $req)
    {
      if ($req->risk_contact == null || empty($req->risk_contact)) {
  			$new_status = ['1', '2'];
  		} else {
  			$risk_contact= $req->risk_contact;
  		}
      // dd($uid_prefix);
      if (empty($req->created_date1) || $req->created_date1 == null) {
        $created_date1 = Date('Y-m-d');
      } else {
        $created_date1=$this->convertDateToMySQL($req ->input ('created_date1'));
      }
      if (empty($req->created_date2) || $req->created_date2 == null) {
        $created_date2 = Date('Y-m-d');
      } else {
        $created_date2= $this->convertDateToMySQL($req ->input ('created_date2'));
      }
      $data = array(
        'risk_contact'=>$risk_contact,
        'created_date1'=>$created_date1,
        'created_date2'=>$created_date2,
      );

      // return $data;

          return Excel::download(new ContactExportbyDay($data), 'ContactExportbyDay.csv');
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
    protected function convertDatearrayToMySQL($date='00/00/0000') {
      if (!is_null($date) || !empty($date)) {
        $ep = explode("/", $date[]);
        $string = $ep[2]."-".$ep[1]."-".$ep[0];
      } else {
        $string = NULL;
      }
      return $string;
    }

}

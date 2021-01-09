<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use auth;
use Carbon\Carbon;
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
        $user_id = Auth::user()->id;
        $dategenerate = Carbon::now()->timestamp;
        $export_amount = Carbon::now();
        $expire_date = $export_amount->copy()->addDays(5);
        $start_date = $created_date2;
        $end_date =$created_date2;
        // echo "$end_date\n";
        // exit;
      // return $data;

      $storefile = Excel::store(new ContactExportbyDay($data), 'ContactExportbyDay'.$user_id.$dategenerate.'.xls','export' );
      if ($storefile) {
        $res1	= DB::table('log_contact_export')->insert([
          'ref_user_id' => $user_id,
          'file_name' => 'ContactExportbyDay'.$user_id.$dategenerate.'',
          'file_imme_type' => '.xls',
          'start_date' => $start_date,
          'end_date' => $end_date,
          // 'export_amount' => $export_amount,
          'expire_date' => $expire_date
        ]);
        // return Excel::download(new ContactExportbyDay($data), 'ContactExportbyDay'.$user_id.$dategenerate.'.csv');
           return redirect()->route('allcontactexport');
        // return response()->download(public_path('export\ContactExportbyDay'.$user_id.$dategenerate.'.xls'));
      }else {
        echo "เกิดข้อผิดพลาด";
      }
          // return Excel::download(new ContactExportbyDay($data), 'ContactExportbyDay'.$user_id.$dategenerate.'.csv');
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

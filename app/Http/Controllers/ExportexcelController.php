<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Excel;

class ExportExcelController extends MasterController
{
    function index()
    {
     $invest_pt_data = DB::table('invest_pt')
     ->get();
     return view('form.contact.export_excel')->with('invest_pt_data', $invest_pt_data);
    }

    function exceldownload(Request $req)
    {
      $arr_sym_cough=$this->sym_cough();
      $arr_sym_snot=$this->sym_snot();
      $arr_sym_sore=$this->sym_sore();
      $arr_sym_dyspnea=$this->sym_dyspnea();
      $arr_sym_breathe=$this->sym_breathe();
      $arr_sym_stufefy=$this->sym_stufefy();
      $arr_occupation=$this->occupation();
      $arr_disch_st=$this->disch_st();
      $arr_pui_type=$this->pui_type();
      $arr = parent::getStatus();
      // dd($arr['news_st']['1']);
      // dd($arr);
      $notify_date=$this->convertDateToMySQL($req ->input ('notify_date'));
      $notify_date_end= $this->convertDateToMySQL($req ->input ('notify_date_end'));
            $filename="SAT_report_".$notify_date."_".$notify_date_end;
      // dd($notify_date_end);
     $invest_pt_data = DB::table('invest_pt')
                      ->select('*')
                      ->whereDate('notify_date','>=',$notify_date)
                      ->whereDate('notify_date', '<=',$notify_date_end)
                      ->get()
                      ->toArray();
     $invest_pt_array[] = array('ลำดับ',
                                'วันที่รับแจ้ง',
                                'เวลา',
                                 'PUI Type',
                                 'Code Case',
                                  'คำนำหน้าชื่อ',
                                  'ชื่อ',
                                  'ชื่อกลาง',
                                   'นามสกุล',
                                   'อาชีพ',
                                   'สัญชาติ',
                                    'อายุ ปี',
                                    'ชนิดผู้ป่วย',
                                    'เที่ยวบิน',
                                    'ผู้ป่วยมาจาก',
                                     'เดินทางมาถึงประเทศไทย',
                                     'ผู้ร่วมเดินทาง (จำนวนคน)',
                                      'วันเริ่มป่วย',
                                      'อุณหภูมิสูงสุด',
                                      'อาการ',
                                       'cxr',
                                       'RP33 จากสถาบันบำราศ',
                                        'Coronavirus family sequencing จาก รพ.จุฬา',
                                        'Coronavirus family sequencingจากกรมวิทย์',
                                        'Coronavirus family sequencingจากศูนย์วิทย์',
                                        'Discharge Status',
                                        'Discharge Date',
                                      'วินิจฉัยสุดท้าย',
                                    'แจ้งผล lab ไปสคร./สปคม.');
                                        // dd($invest_pt_array);
$i = 1;
     foreach($invest_pt_data as $value)
     {
      $invest_pt_array[] = array(
            'id'  => $i,
            'notify_date'  => (!empty($value->notify_date)) ? $value->notify_date : "",
            'notify_time'  => $value->notify_time,
            'pui_type'  => (isset($arr['pui_type'][$value->pui_type])) ? $arr['pui_type'][$value->pui_type] : "",
            'sat_id'  => $value->sat_id,
            'title_name'  => $value->title_name,
            'first_name'  => $value->first_name,
            'mid_name'  => $value->mid_name,
            'last_name'  => $value->last_name,
            'occupation'  => $arr_occupation[$value->occupation],
            'nation'  => $value->nation,
            'age'  => $value->age,
            'patian_type'  => $arr_sym_cough[$value ->sym_cough],
            'flight_number'  => $value->flight_number,
            'arrive_from'  => "",
            'risk2_6arrive_date'  => $value->risk2_6arrive_date,
            'total_travel_in_group'  => $value->total_travel_in_group,
            'data3_1date_sickdate'  => $value->data3_1date_sickdate,
            'fever_current'  => $value->fever_current,
            'symptom'  =>$arr_sym_cough[$value ->sym_cough].', '.$arr_sym_snot[$value ->sym_snot].', '.$arr_sym_sore[$value ->sym_sore].', '.$arr_sym_dyspnea[$value ->sym_dyspnea].', '.$arr_sym_breathe[$value ->sym_breathe].', '.$arr_sym_stufefy[$value ->sym_stufefy],
            'xray_result'  => $value->xray_result,
            'RP33'=>"",
            'Coronavirus_family_sequencing_cu'  => "",
            'Coronavirus_family_sequencing_dmsc'  => "",
            'Coronavirus_family_sequencing_rmsc'  => "",
            'disch_st'  => $arr_disch_st[$value->disch_st],
            'disch_date'   => "",
            'last_diagnose'=>"",
            'result_lab_to_odpc'=>""

    );
$i++;
     }
           dd($invest_pt_array);
     Excel::create($filename, function($excel) use ($invest_pt_array){
      $excel->setTitle('PUI Data SAT');
      $excel->sheet('PUI Data SAT', function($sheet) use ($invest_pt_array){
       $sheet->fromArray($invest_pt_array, null, 'A1', false, false);
      });
     })->download('xlsx');
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

      protected function sym_cough(){
        $list_sym_cough = array(
    			'y'=>'ไอ',
    			'n'=>''
    			);
    		// dd($list_sym_cough);
    		return $list_sym_cough;
    	}
      protected function sym_snot(){
        $list_sym_snot = array(
          'y'=>'น้ำมูก',
          'n'=>''
          );
        // dd($list_sym_cough);
        return $list_sym_snot;
      }
      protected function sym_sore(){
        $list_sym_sore = array(
          'y'=>'เจ็บคอ',
          'n'=>''
          );
        // dd($list_sym_cough);
        return $list_sym_sore;
      }
      protected function sym_dyspnea(){
        $list_sym_dyspnea = array(
          'y'=>'หายใจเหนื่อย',
          'n'=>''
          );
        // dd($list_sym_cough);
        return $list_sym_dyspnea;
      }
      protected function sym_breathe(){
        $list_sym_breathe = array(
          'y'=>'หายใจลำบาก',
          'n'=>''
          );
        // dd($list_sym_cough);
        return $list_sym_breathe;
      }
      protected function sym_stufefy(){
        $list_sym_stufefy = array(
          'y'=>'ซึม',
          'n'=>''
          );
        // dd($list_sym_cough);
        return $list_sym_stufefy;
      }
      protected function disch_st(){
        $list_disch_st = array(
          '1'=>'Recovery',
          '2'=>'Admit',
          '3'=>'Death'
          );
        // dd($list_sym_cough);
        return $list_disch_st;
      }
      protected function pui_type(){
        $list_pui_type = array(
          '1'=>'New PUI',
          '2'=>'Contact PUI',
          '3'=>'PUO',
          '4'=>'Confirm nCov 2019',
          ''=>''
          );
        // dd($list_sym_cough);
        return $list_pui_type;
      }
      protected function occupation(){
        $list_occupation = array(
                                      '1'=>'งาน/ดูแลบ้าน',
          														'2'=>'เกษตรกร (ปลูกพืช)',
          														'3'=>'เกษตรกร (เลี้ยงสัตว์)',
          														'4'=>'ประมง/จับสัตว์น้ำ',
          														'5'=>'ค้าขาย/ธุรกิจส่วนตัว',
          														'6'=>'พนักงานบริษัท/โรงงาน',
          														'7'=>'ข้าราชการ',
          														'8'=>'เด็กเล็ก/ในปกครง',
          														'9'=>'นักเรียน/นักศึกษา',
          														'10'=>'นักบวช',
          														'11'=>'บุคลากรทางสาธารณสุข',
          														'12'=>'รับจ้างทั่วไป/กรรมกร',
          														'13'=>'ว่างงาน',
          														'14'=>'เจ้าหน้าที่บนเครื่องบิน',
          														'15'=>'เจ้าหน้าที่สนามบิน',
          														'16'=>'พนักงานขับรถโดยสาร',
          														'17'=>'มัคคุเทศก์/ไกด์ทัวร์',
          														'18'=>'พนักงานโรงแรม',
          														'99'=>'อื่นๆ',
                                      '0'=>'',
                                      ''=>''
          );
        // dd($list_sym_cough);
        return $list_occupation;
      }
}
?>

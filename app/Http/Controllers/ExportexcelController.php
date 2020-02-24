<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\GlobalCountry;
class ExportExcelController extends MasterController
{

  // all table
  public function alltable(Request $req)
  {
    $datenow = date('Y-m-d');
    $arr = parent::getStatus();
    $nation_list = $this->arrnation();
    // dd($poe_id);
    $data=DB::table('invest_pt')
            ->select('*')
            ->where('notify_date', $datenow)
            ->get();
    return view('export.export_excel',compact(
      'data',
      'arr',
      'nation_list'
    ));
  }
  public function alltableexport(Request $req)
  {
    $datenow = date('Y-m-d');
    $arr = parent::getStatus();
    $arr_hos = $this->arr_hos();
    $nation_list = $this->arrnation();
    // dd($poe_id);
    $data=DB::table('invest_pt')
            ->select('*')
            ->where('notify_date', $datenow)
            ->get();
    return view('export.allexport',compact(
      'data',
      'arr',
      'arr_hos',
      'nation_list'
    ));
  }


    function index(Request $req)
    {
      $arr = parent::getStatus();
      $notify_date=$this->convertDateToMySQL($req ->input ('notify_date'));
      $notify_date_end= $this->convertDateToMySQL($req ->input ('notify_date_end'));
      $nation_list = $this->arrnation();
      $data=DB::table('invest_pt')
                      ->select('*')
                      ->whereDate('notify_date','>=',$notify_date)
                      ->whereDate('notify_date', '<=',$notify_date_end)
                      ->get();
                      return view('export.export_excel',compact(
                        'data',
                        'arr',
                        'nation_list'
                      ));
   }
   function indexallexcel(Request $req)
   {
     $arr = parent::getStatus();
     $arr_hos = $this->arr_hos();
     $nation_list = $this->arrnation();
     $arr_occupation = $this->arr_occupation();
     $sym_cough = $this->sym_cough();
     $notify_date=$this->convertDateToMySQL($req ->input ('notify_date'));
     $notify_date_end= $this->convertDateToMySQL($req ->input ('notify_date_end'));
     $data=DB::table('invest_pt')
                     ->select('*')
                     ->whereDate('notify_date','>=',$notify_date)
                     ->whereDate('notify_date', '<=',$notify_date_end)
                     ->get();

                  //dd($data);
                     return view('export.allexport',compact(
                       'data',
                       'arr',
                       'arr_hos',
                       'nation_list',
                       'arr_occupation',
                       'sym_cough'
                     ));
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
          '3'=>'Death',
          ''=>''
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
      protected function arrnation(){
    		$arrnation = DB::table('ref_global_country')->select('country_id','country_name')->get();
    		foreach ($arrnation as  $value) {
    			$arrnation[$value->country_id] =trim($value->country_name);
    		}
    		// dd($province_arr);
    		return $arrnation;
    	}
      protected function arr_occupation(){
        $arr_occupation = DB::table('ref_occupation')->select('id','occu_name_th')->get();
        foreach ($arr_occupation as  $value) {
          $arr_occupation[$value->id] =trim($value->occu_name_th);
        }
        // dd($province_arr);
        return $arr_occupation;
      }
      protected function arr_hos(){
        $arr_hos = DB::table('chospital_new')->select('hospcode','hosp_name')->get();
        foreach ($arr_hos as  $value) {
          $arr_hos[$value->hospcode] =trim($value->hosp_name);
        }
        // dd($province_arr);
        return $arr_hos;
      }
}
?>

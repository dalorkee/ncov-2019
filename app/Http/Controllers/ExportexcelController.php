<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\GlobalCountry;
use App\InvestList;
use App\RiskType;

class ExportExcelController extends MasterController
{

  // all table
public function alltable(Request $req)
{
	return view('errors.405');
/*
    $datenow = date('Y-m-d');
    $arr = parent::getStatus();
    $nation_list = $this->arrnation();

    $data=DB::table('invest_pt')
            ->select('*')
            ->where('notify_date', $datenow)
            ->whereNull('deleted_at')
            ->get();
    return view('errors.405',compact(
      'data',
      'arr',
      'nation_list'
    ));
	*/
  }



public function index(Request $req)
{
	return view('errors.405');
	/*
      $arr = parent::getStatus();
      $notify_date=$this->convertDateToMySQL($req ->input ('notify_date'));
      $notify_date_end= $this->convertDateToMySQL($req ->input ('notify_date_end'));
      $pt_status= $req ->input ('pt_status');
      $nation_list = $this->arrnation();
      $data=DB::table('invest_pt')
                      ->select('*')
                      ->whereDate('notify_date','>=',$notify_date)
                      ->whereDate('notify_date', '<=',$notify_date_end)
                      ->whereNull('deleted_at')
                      ->get();
                      // return view('export.export_excel',compact(
                      //   'data',
                      //   'arr',
                      //   'nation_list'
                      // ));
                      return view('errors.405',compact(
                        'data',
                        'arr',
                        'nation_list'
                      ));
	*/
   }

   public function alltableexport(Request $req)
   {

	$uid = auth()->user()->id;
	if ($uid == 2 || $uid == 97 || $uid == 30) {
		 $datenow = date('Y-m-d');
		 $arr = parent::getStatus();
		 $arr_hos = $this->arr_hos();
		 $arrprov = $this->arrprov();
		 $arr_city = $this->arr_city();
		 $list_occupation = $this->list_occupation();
		 $nation_list = $this->arrnation();
		 $list_airport = $this->list_airport();
		 $arr_refer_lab = $this->arr_refer_lab();
		 $arr_refer_bidi = $this->arr_refer_bidi();
		 $arr_op_opt = $this->arr_op_opt();
		 $arr_op_dpc = $this->arr_op_dpc();
		 $arr_hostype  = $this->arr_hostype();
		 $arr_hostype_th  = $this->arr_hostype_th();
		 $risk_type = RiskType::all()->toArray();
		 foreach($risk_type as $val_risk_type){
			 $arr_risk_type[$val_risk_type['id']] = $val_risk_type['risk_name'];
		 }
		 $data=DB::table('invest_pt')
				 ->select('*')
				 ->where('notify_date', $datenow)
				 ->whereNull('deleted_at')
				 ->get();
		  return view('export.allexport',compact(
		    'data',
		    'arr',
		    'arr_hos',
		    'nation_list',
		    'list_occupation',
		    'arrprov',
		    'list_airport',
		    'arr_refer_bidi',
		    'arr_refer_lab',
		    'arr_op_opt',
		   'arr_op_dpc',
			'arr_city',
		  'arr_hostype',
		   'arr_hostype_th',
			 'arr_risk_type',
		  ));
	} else {
		return view('errors.405');
	}

		 /*
		 return view('errors.405',compact(
		   'data',
		   'arr',
		   'arr_hos',
		   'nation_list',
		   'list_occupation',
		   'arrprov',
		   'list_airport',
		   'arr_refer_bidi',
		   'arr_refer_lab',
		   'arr_op_opt',
		   'arr_op_dpc',
		   'arr_city',
		   'arr_hostype',
		   'arr_hostype_th'
		 ));
		 */
   }

public function indexallexcel(Request $req)
{
	$uid = auth()->user()->id;
	if ($uid == 2 || $uid == 97 || $uid == 30) {
		 $arr = parent::getStatus();
		 $arr_hos = $this->arr_hos();
		 $arrprov = $this->arrprov();
		 $nation_list = $this->arrnation();
		 $arr_city = $this->arr_city();
		 $list_airport = $this->list_airport();
		 $list_occupation = $this->list_occupation();
		 $sym_cough = $this->sym_cough();
		 $arr_refer_lab = $this->arr_refer_lab();
		 $arr_refer_bidi = $this->arr_refer_bidi();
		 $arr_op_opt = $this->arr_op_opt();
		 $arr_op_dpc = $this->arr_op_dpc();
		 $arr_hostype = $this->arr_hostype();
		 // $pt_status= $req ->input ('pt_status');
		 $pt_status1= $req ->input ('pt_status1');
		 $pt_status2= $req ->input ('pt_status2');
		 $pt_status3= $req ->input ('pt_status3');
		 $pt_status4= $req ->input ('pt_status4');
		 $pt_status5= $req ->input ('pt_status5');
		 $arr_hostype_th  = $this->arr_hostype_th();
		 $notify_date=$this->convertDateToMySQL($req ->input ('notify_date'));
		 $notify_date_end= $this->convertDateToMySQL($req ->input ('notify_date_end'));
		 $risk_type = RiskType::all()->toArray();
		 foreach($risk_type as $val_risk_type){
			 $arr_risk_type[$val_risk_type['id']] = $val_risk_type['risk_name'];
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

		if ($req->pt_status == null || empty($req->pt_status)) {
			$new_status = ['1', '2', '3', '4', '5'];
		} else {
			$new_status = $req->pt_status;
		}
		$data = InvestList::whereIn('pt_status', $new_status)
						->whereBetween('notify_date', [$notify_date, $notify_date_end])
						/*
			$data=DB::table('invest_pt')
						->select('*')
						  ->wherein('pt_status',[$pt_status1,$pt_status2,$pt_status3,$pt_status4,$pt_status5])
						  ->whereDate('notify_date','>=',$notify_date)
						  ->whereDate('notify_date', '<=',$notify_date_end)
						  */
						  ->whereNull('deleted_at')
						  ->get();

						 return view('export.allexport',compact(
							'data',
							'arr',
							'arr_hos',
							'arr_refer_bidi',
							'arr_refer_lab',
							'nation_list',
						   'list_occupation',
							'sym_cough',
							'arrprov',
							'list_airport',
							'arr_op_opt',
							'arr_op_dpc',
							'arr_city',
							'arr_hostype',
							'arr_hostype_th',
							'arr_risk_type',
						  ));
	}

					 /*
                     return view('errors.405',compact(
                       'data',
                       'arr',
                       'arr_hos',
                       'arr_refer_bidi',
                       'arr_refer_lab',
                       'nation_list',
                       'list_occupation',
                       'sym_cough',
                       'arrprov',
                       'list_airport',
                       'arr_op_opt',
                       'arr_op_dpc',
                       'arr_city',
                       'arr_hostype',
                       'arr_hostype_th'
                     )); */
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
      protected function arr_refer_bidi(){
        $arr_refer_bidi = array(
          'Y'=>'รับ Refer',
          ''=>'',
          'n'=>''
          );
        // dd($list_sym_cough);
        return $arr_refer_bidi;
      }
      protected function arr_refer_lab(){
        $arr_refer_lab = array(
          'Y'=>'รับ Lab',
          ''=>'',
          'n'=>''
          );
        // dd($list_sym_cough);
        return $arr_refer_lab;
      }
      protected function arr_op_opt(){
        $arr_op_opt = array(
          'Y'=>'ทีม Operation ลงเอง',
          ''=>'',
          'n'=>''
          );
        // dd($list_sym_cough);
        return $arr_op_opt;
      }
      protected function arr_op_dpc(){
        $arr_op_dpc = array(
          'Y'=>'ทีม สคร. ลง',
          ''=>'',
          'n'=>''
          );
        // dd($list_sym_cough);
        return $arr_op_dpc;
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
      protected function list_occupation(){
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
      protected function list_airport(){
        $list_airport = array(
                                      '10'=>'สนามบินภูเก็ต',
                                      '11'=>'สนามบินเชียงราย',
                                      '12'=>'สนามบินอุดรธานี',
                                      '13'=>'สนามบินอุบลราชธานี',
                                      '14'=>'สนามบินกระบี่',
                                      '42'=>'สนามบินอู่ตะเภา',
                                      '43'=>'สนามบินสุราษฎร์ธานี',
                                      '44'=>'สนามบินสมุย',
                                      '7'=>'สนามบินสุวรรณภูมิ',
                                      '8'=>'สนามบินดอนเมือง',
                                      '9'=>'สนามบินเชียงใหม่',
                                      '0'=>'',
                                      ''=>''
          );
        // dd($list_sym_cough);
        return $list_airport;
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
      protected function arr_city(){
        $arr_city = DB::table('ref_global_city')->select('city_id','city_name')->get();
        foreach ($arr_city as  $value) {
          $arr_city[$value->city_id] =trim($value->city_name);
        }
        // dd($province_arr);
        return $arr_city;
      }
      protected function arrprov(){
        $arrprov = DB::table('ref_province')->select('province_id','province_name')->get();
        foreach ($arrprov as  $value) {
          $arrprov[$value->province_id] =trim($value->province_name);
        }
        // dd($province_arr);
        return $arrprov;
      }
      protected function arr_hostype(){
        $arr_hostype = DB::table('chospital_new')->select('hospcode','hosp_type_code')->get();
        foreach ($arr_hostype as  $value) {
          $arr_hostype[$value->hospcode] =trim($value->hosp_type_code);
        }
        // dd($province_arr);
        return $arr_hostype;
      }
      protected function arr_hostype_th(){
        $arr_hostype_th = array(
          '01'=>'โรงพยาบาลรัฐ',
          '02'=>'โรงพยาบาลรัฐ',
          '03'=>'โรงพยาบาลรัฐ',
          '04'=>'โรงพยาบาลรัฐ',
          '05'=>'โรงพยาบาลรัฐ',
          '06'=>'โรงพยาบาลรัฐ',
          '07'=>'โรงพยาบาลรัฐ',
          '08'=>'โรงพยาบาลรัฐ',
          '09'=>'โรงพยาบาลรัฐ',
          '10'=>'โรงพยาบาลรัฐ',
          '11'=>'โรงพยาบาลรัฐ',
          '12'=>'โรงพยาบาลรัฐ',
          '13'=>'โรงพยาบาลรัฐ',
          '14'=>'โรงพยาบาลรัฐ',
          '15'=>'โรงพยาบาลเอกชน',
          '16'=>'โรงพยาบาลเอกชน',
          '17'=>'โรงพยาบาลรัฐ',
          '18'=>'โรงพยาบาลรัฐ',
          ''=>''
          );
        // dd($list_sym_cough);
        return $arr_hostype_th;
      }

}
?>

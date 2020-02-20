<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use Carbon\Carbon;
use Haruncpi\LaravelIdGenerator\IdGenerator;
class ContactController extends MasterController
{
  // allcontact table
	public function allcasecontacttable(Request $req)

{
  if(auth()->user()->id==Auth::user()->id){
		$contact_data=
									DB::table('tbl_contact')
												->join('users','tbl_contact.user_id','=','users.id')
												->select('tbl_contact.*','users.id','users.prefix_sat_id')
												->where('users.prefix_sat_id',Auth::user()->prefix_sat_id)
												->get();
		$nation_list = $this->arrnation();
		$arr_occu = $this->arroccu();
		$arrprov = $this->arrprov();
		$arrdistrict = $this->arrdistrict();
		$arr_sub_district = $this->arr_sub_district();
		$arr_division_follow_contact = $this->arr_division_follow_contact();
    return view('form.contact.allcasecontacttable',compact(
			'contact_data',
			'nation_list',
			'arr_occu',
			'arrprov',
			'arrdistrict',
			'arr_division_follow_contact',
			'arr_sub_district'
    ));
  }
}
	// allcontact table
	public function editstatus(Request $req)
	{
		$sat_id=$req->sat_id;
		// $poe_id=$req->poe_id;
		$contact_id=$req->contact_id;
		// dd($poe_id);
		$contact_data=DB::table('tbl_contact')->select('*')->get();
		return view('form.contact.editstatus',compact(
			'contact_data'
		));
	}


  // indexcontact table
  public function contacttable(Request $req)
  {
		// $sat_id=$req->sat_id;
		$id=$req->id;
		$nation_list = $this->arrnation();
		$arr_occu = $this->arroccu();
		$arrprov = $this->arrprov();
		$arrdistrict = $this->arrdistrict();
		$arr_sub_district = $this->arr_sub_district();
		// dd($poe_id);
		$patian_data=DB::table('invest_pt')->select('*')->where('id', [$req->id] )->get();
		$contact_data=DB::table('tbl_contact')->select('*')->where('pui_id', $id)->get();
    return view('form.contact.contacttable',compact(
			'contact_data',
			'id',
			'patian_data',
			'nation_list',
			'arr_occu',
			'arrprov',
			'arrdistrict',
			'arr_sub_district'
    ));
  }


  public function contactfollowtable(Request $req)
  {
		$arr = parent::getStatus();
		$sat_id=$req->sat_id;
		$patian_date=DB::table('tbl_followupcontact')->where('contact_id', \DB::raw("(select max(`contact_id_day`) from tbl_followupcontact)"))->get();
		$patian_data=DB::table('invest_pt')->select('*')->where('sat_id', [$req->sat_id] )->get();
		$contact_data=DB::table('tbl_contact')->select('*')->where('sat_id', $sat_id)->get();
		$fucontact_data=DB::table('tbl_followupcontact')->select('*')->where('contact_id', $req->contact_id)->get();
		$contact_id=$req->contact_id;
		$contact_id_day=$req->contact_id_day;
		$arr_division_follow_contact = $this->arr_division_follow_contact();
    return view('form.contact.contactfollowtable',compact(
			'sat_id',
			// 'poe_id',
			'contact_id_day',
			'contact_id',
			'fucontact_data',
			'contact_data',
			'patian_date',
			'patian_data',
			'arr_division_follow_contact',
			'arr'
    ));
  }


	// form contact add
	public function detailcontact(Request $req)
	{
		$contact_id=$req->contact_id;
		$sat_id=$req->sat_id;
		$ref_title_name=DB::table('ref_title_name')->select('*')->get();
		$nation_list = $this->arrnation();
		$arr_occu = $this->arroccu();
		$arrprov = $this->arrprov();
		$arrsymptoms = $this->arrsymptoms();
		$arrspecimen = $this->arrspecimen();
		$ref_specimen=DB::table('ref_specimen')->select('*')->get();
		$ref_detail_contact=DB::table('tbl_contact')
												->select('name_contact',
																 'mname_contact',
																 'lname_contact',
																 'passport_contact',
																 'sex_contact',
																 'age_contact',
																 'passport_contact',
																 'national_contact',
																 'address_contact',
																 'phone_contact',
																 'patient_contact',
																 'datecontact',
																 'type_contact')
												->where('contact_id',$req->contact_id)
												->get();
		$ref_detail_pt=DB::table('invest_pt')
														->select('first_name',
																			'mid_name',
																			'last_name',
																			'sex',
																			'age',
																			'nation',
																			'occupation',
																			'isolated_province')
														  ->where('id',$req->pui_id)
															->get();
		$ref_detail_follow=DB::table('tbl_followupcontact')
            					->select('*')
											->where('contact_id',$req->contact_id)
            					->get();
		$ref_global_country=DB::table('ref_global_country')->select('country_id','country_name')->get();
		$sat_id=$req->sat_id;
		return view('form.contact.detailcontact',compact(
			'ref_title_name',
			'ref_specimen',
			'ref_global_country',
			'ref_detail_contact',
			'ref_detail_pt',
			'ref_detail_follow',
			'sat_id',
			'nation_list',
			'arr_occu',
			'arrprov',
			'arrsymptoms',
			'arrspecimen'
		));
	}


  // form contact add
  public function addcontact(Request $req)
	{
		$pui_id=$req->id;
		$ref_title_name=DB::table('ref_title_name')->select('*')->get();
		$ref_specimen=DB::table('ref_specimen')->select('*')->get();
		$ref_global_country=DB::table('ref_global_country')->select('country_id','country_name')->get();
		$sat_id=DB::table('invest_pt')->select('sat_id')->where('id', $pui_id )->get();
    $listprovince=$this->province();
    $listcountry=$this->arrnation();
		$entry_user = Auth::user()->id;
		$prefix_sat_id = Auth::user()->prefix_sat_id;
		return view('form.contact.addcontact',compact(
      'listprovince',
      'listcountry',
			'ref_title_name',
			'ref_specimen',
			'ref_global_country',
			'sat_id',
			'prefix_sat_id',
			'entry_user',
			'pui_id'
    ));
	}


	public function editcontact(Request $req)
	{
		$contact_id=$req->contact_id;
		$getdata_contact=DB::table('tbl_contact')->select('*')->where('contact_id',$contact_id)->get();
		$ref_title_name=DB::table('ref_title_name')->select('*')->get();
		$ref_specimen=DB::table('ref_specimen')->select('*')->get();
		$ref_global_country=DB::table('ref_global_country')->select('country_id','country_name')->get();
		$arrtitlename=$this->arrtitlename();
		$arr_type_contact = $this->arr_type_contact();
		$arr_division_follow_contact = $this->arr_division_follow_contact();
		$arr_hos = $this->arr_hos();
		$arr_status_followup = $this->arr_status_followup();
		$arr_available_contact = $this->arr_available_contact();
		$arr_follow_results = $this->arr_follow_results();
		// $arrtitlename = $this->arrtitlename();
		// $sat_id=$req->sat_id;
		$contact_id=$req->contact_id;
    $listprovince=$this->province();
		$arr_province=$this->arr_province();
		$arrdistrict=$this->arrdistrict();
		$arr_risk_contact=$this->arr_risk_contact();
		$arr_sub_district=$this->arr_sub_district();
    $listcountry=$this->arrnation();
		$entry_user = Auth::user()->id;
		$prefix_sat_id = Auth::user()->prefix_sat_id;
		return view('form.contact.editcontact',compact(
      'listprovince',
      'listcountry',
			'ref_title_name',
			'ref_specimen',
			'ref_global_country',
			'contact_id',
			'prefix_sat_id',
			'entry_user',
			'getdata_contact',
			'arrtitlename',
			'arr_province',
			'arrdistrict',
			'arr_sub_district',
			'arr_risk_contact',
			'arr_type_contact',
			'arr_division_follow_contact',
			'arr_hos',
			'arr_status_followup',
			'arr_available_contact',
			'arr_follow_results'
    ));
	}


  public function followupcontact(Request $req)
  {
		$ref_title_name=DB::table('ref_title_name')->select('*')->get();
		$ref_specimen=DB::table('ref_specimen')->select('*')->get();
		$followup_date=DB::table('tbl_followupcontact')->where('contact_id', $req->contact_id)->max('contact_id_day');
		$ref_global_country=DB::table('ref_global_country')->select('country_id','country_name')->get();
		$sat_id=DB::table('tbl_contact')->select('pui_id','sat_id')->where('contact_id', $req->contact_id )->get();
		$contact_id=$req->contact_id;
		$contact_id_day=$req->contact_id_day;
		$listprovince=$this->province();
		$entry_user = Auth::user()->id;
		$prefix_sat_id = Auth::user()->prefix_sat_id;
    return view('form.contact.followupcontact',compact(
			'listprovince',
			'ref_title_name',
			'ref_specimen',
			'ref_global_country',
			'sat_id',
			'followup_date',
			'prefix_sat_id',
			'contact_id_day',
			'contact_id',
			'entry_user'
    ));
  }


  public function contactinsert(Request $req)

 {
	 $contact_id = $req ->input ('contact_id');
	 $contact_id_temp = $req ->input ('contact_id_temp');
	 if ($contact_id == $contact_id_temp) {
		 $contact_id_temp = $req ->input ('contact_id_temp');
	 }else {
		 $contact_id_temp = "";
	 }

	// $update_pt = DB::table('invest_pt')
	// 						->where('id', $req ->input ('pui_id'))
	// 						->update(['cont' => "y"]);
	// if ($update_pt)
	{
	// $contactid=uniqid();
  // $poe_id = $req ->input ('poe_id');
	$sat_id = $req ->input ('sat_id');
	$pui_id = $req ->input ('pui_id');
  // $contact_id = $poe_id.'_'.$contactid;	// dd($order);
	$user_id = $req ->input ('user_id');
	$title_contact = $req ->input ('title_contact');
  $name_contact = $req ->input ('name_contact');
  $mname_contact = $req ->input ('mname_contact');
  $lname_contact = $req ->input ('lname_contact');
  $sex_contact = $req ->input ('sex_contact');
  $age_contact = $req ->input ('age_contact');
	$passport_contact = $req ->input ('passport_contact');
  $national_contact = $req ->input ('national_contact');
  $province = $req ->input ('province');
  $district = $req ->input ('district');
  $sub_district = $req ->input ('sub_district');
  $address_contact = $req ->input ('address_contact');
  $phone_contact = $req ->input ('phone_contact');
  $patient_contact = $req ->input ('patient_contact');
  $risk_contact = $req ->input ('risk_contact');
  $datecontact = $this->convertDateToMySQL($req ->input ('datecontact'));
  $datefollow = $this->convertDateToMySQL($req ->input ('datefollow'));
	$date_followup = $this->convertDateToMySQL($req ->input ('date_followup'));
  $type_contact = $req ->input ('type_contact');
	$province_follow_contact = $req ->input ('province_follow_contact');
	$division_follow_contact = $req ->input ('division_follow_contact');
	$division_follow_contact_other = $req ->input ('division_follow_contact_other');
	$sat_id_class = $req ->input ('sat_id_class');
	$hospcode = $req ->input ('hospcode');
	$clinical = $req ->input ('clinical');
	$fever = $req ->input ('fever');
	$cough = $req ->input ('cough');
	$sore_throat = $req ->input ('sore_throat');
	$mucous = $req ->input ('mucous');
	$sputum = $req ->input ('sputum');
	$breath_labored = $req ->input ('breath_labored');
	$suffocate = $req ->input ('suffocate');
	$muscle_aches = $req ->input ('muscle_aches');
	$headache = $req ->input ('headache');
	$diarrhea = $req ->input ('diarrhea');
	$status_followup = $req ->input ('status_followup');
	$available_contact = $req ->input ('available_contact');
	$follow_results = $req ->input ('follow_results');
  $date_entry = date('Y-m-d') ;
  $data = array(
    // 'poe_id'=>$poe_id,
		'sat_id'=>$sat_id,
		'pui_id'=>$pui_id,
    'contact_id'=>$contact_id,
		'contact_id_temp'=>$contact_id_temp,
		'title_contact'=>$title_contact,
    'name_contact'=>$name_contact,
    'mname_contact'=>$mname_contact,
    'lname_contact'=>$lname_contact,
    'sex_contact'=>$sex_contact,
    'age_contact'=>$age_contact,
		'passport_contact'=>$passport_contact,
    'national_contact'=>$national_contact,
    'province'=>$province,
    'district'=>$district,
    'sub_district'=>$sub_district,
    'address_contact'=>$address_contact,
    'phone_contact'=>$phone_contact,
    'patient_contact'=>$patient_contact,
    'risk_contact'=>$risk_contact,
    'datecontact'=>$datecontact,
    'datefollow'=>$datefollow,
		'date_followup'=>$date_followup,
    'type_contact'=>$type_contact,
		'user_id'=>$user_id,
		'province_follow_contact'=>$province_follow_contact,
		'division_follow_contact'=>$division_follow_contact,
		'division_follow_contact_other'=>$division_follow_contact_other,
		'sat_id_class'=>$sat_id_class,
		'hospcode'=>$hospcode,
		'clinical'=>$clinical,
		'fever'=>$fever,
		'cough'=>$cough,
		'sore_throat'=>$sore_throat,
		'mucous'=>$mucous,
		'sputum'=>$sputum,
		'breath_labored'=>$breath_labored,
		'suffocate'=>$suffocate,
		'muscle_aches'=>$muscle_aches,
		'headache'=>$headache,
		'diarrhea'=>$diarrhea,
		'status_followup'=>$status_followup,
		'available_contact'=>$available_contact,
		'follow_results'=>$follow_results,
    'date_entry'=>$date_entry
  );
      // dd($data);
  $res1	= DB::table('tbl_contact')->insert($data);
//   if ($res1)
//   {
//     $dms_pcr_contact =$req ->input('dms_pcr_contact');
//     $dms_time_contact =$req ->input('dms_time_contact');
//     $dms_date_contact =$req ->input ('dms_date_contact');
// 		$dms_date_contact_s = str_replace('/', '-', $dms_date_contact);
// 		// $dms_date_contact_ss = date('Y-m-d', strtotime($dms_date_contact_s));
//     $dms_specimen_contact =$req ->input('dms_specimen_contact');
//     $chkspec_other_contact =$req ->input('chkspec_other_contact');
//     $other_pcr_result_contact =$req ->input('other_pcr_result_contact');
//      // exit;
//     // $date_entry =date('Y-m-d') ;
// $x=0;
//     for ($i=0; $i < count($dms_pcr_contact); $i++) {
//       $data_hsc[]  = [
//                  // 'no'=>$team_id[$i],
//                 // 'poe_id'=>$poe_id,
//                 'contact_id'=>$contact_id,
//                 'dms_pcr_contact'=>$dms_pcr_contact[$i],
//                 'dms_time_contact'=>$dms_time_contact[$i],
//                 'dms_date_contact'=>$dms_date_contact_s[$i],
//                 'dms_specimen_contact'=>$dms_specimen_contact[$i],
//                 'chkspec_other_contact' => $chkspec_other_contact[$i],
//                 'other_pcr_result_contact' => $other_pcr_result_contact[$i],
//                 'date_entry' => $date_entry
//               ];
//               $x++;
//             }
    // dd($data_hsc);
    // exit;
    // $res3	= DB::table('tbl_contact_hsc')->insert($data_hsc);
// }
  if ($res1){
		return redirect()->route('contactfollowtable',[$contact_id])->with('message','Insert Success : '.$pui_id);
	}else{
		return redirect()->route('contactfollowtable',[$contact_id])->with('message','ERROR : '.$pui_id);
		}
}
}

public function followupcontactinsert(Request $req)
{

// $poe_id = $req ->input ('poe_id');
$sat_id = $req ->input ('sat_id');
$pui_id = $req ->input ('pui_id');
$contact_id = $req ->input ('contact_id');
$contact_id_day= $req ->input ('contact_id_day');
$date_no = $this->convertDateToMySQL($req ->input ('date_no'));
$clinical = $req ->input ('clinical');
$fever = $req ->input ('fever');
$cough = $req ->input ('cough');
$sore_throat = $req ->input ('sore_throat');
$mucous = $req ->input ('mucous');
$sputum = $req ->input ('sputum');
$breath_labored = $req ->input ('breath_labored');
$suffocate = $req ->input ('suffocate');
$muscle_aches = $req ->input ('muscle_aches');
$headache = $req ->input ('headache');
$diarrhea = $req ->input ('diarrhea');
$other_symtom = $req ->input ('other_symtom');
$status_followup = $req ->input ('status_followup');
$available_contact = $req ->input ('available_contact');
$follow_results = $req ->input ('follow_results');
$user_id = $req ->input ('user_id');
$province_follow_contact = $req ->input ('province_follow_contact');
$followup_address = $req ->input ('followup_address');
$division_follow_contact = $req ->input ('division_follow_contact');
$division_follow_contact_other = $req ->input ('division_follow_contact_other');
$sat_id_class = $req ->input ('sat_id_class');
$date_entry = date('Y-m-d') ;
$data = array(
	// 'poe_id'=>$poe_id,
	'sat_id'=>$sat_id,
	'pui_id'=>$pui_id,
	'contact_id'=>$contact_id,
	'contact_id_day'=>$contact_id_day + '1',
	'followup_address'=>$followup_address,
	'date_no'=>$date_no,
	'clinical'=>$clinical,
	'fever'=>$fever,
	'cough'=>$cough,
	'sore_throat'=>$sore_throat,
	'mucous'=>$mucous,
	'sputum'=>$sputum,
	'breath_labored'=>$breath_labored,
	'suffocate'=>$suffocate,
	'muscle_aches'=>$muscle_aches,
	'headache'=>$headache,
	'diarrhea'=>$diarrhea,
	'other_symtom'=>$other_symtom,
	'status_followup'=>$status_followup,
	'available_contact'=>$available_contact,
	'follow_results'=>$follow_results,
	'user_id'=>$user_id,
	'province_follow_contact'=>$province_follow_contact,
	'division_follow_contact'=>$division_follow_contact,
	'division_follow_contact_other'=>$division_follow_contact_other,
	'sat_id_class'=>$sat_id_class,
	'date_entry'=>$date_entry
);
    // dd($data);
$res1	= DB::table('tbl_followupcontact')->insert($data);
// if ($res1)
// {
// 	$pcr_contact =$req ->input('pcr_contact');
// 	$specimen_contact =$req ->input('specimen_contact');
// 	$chkspec_other_contact =$req ->input('chkspec_other_contact');
// 	$other_pcr_result_contact =$req ->input('other_pcr_result_contact');
// 	 // exit;
// 	// $date_entry =date('Y-m-d') ;
// $x=0;
// 	for ($i=0; $i < count($pcr_contact); $i++) {
// 		$data_hsc[]  = [
// 							 // 'no'=>$team_id[$i],
// 							 // 'poe_id'=>$poe_id,
// 							'sat_id'=>$sat_id,
// 							'contact_id'=>$contact_id,
// 							'contact_id_day'=>$contact_id_day,
// 							'pcr_contact'=>$pcr_contact[$i],
// 							'specimen_contact'=>$specimen_contact[$i],
// 							'chkspec_other_contact'=>$chkspec_other_contact[$i],
// 							'other_pcr_result_contact'=>$other_pcr_result_contact[$i],
// 							'date_entry' => $date_entry
// 						];
// 						$x++;
// 					}
// 	// dd($ddata_member);
// 	// exit;
// 	$res3	= DB::table('tbl_followupcontact_hsc')->insert($data_hsc);
// }
if ($res1){

	return redirect()->route('contactfollowtable',[$contact_id])->with('message','Insert Success : '.$pui_id);
}else{
	return redirect()->route('contactfollowtable',[$contact_id])->with('message','ERROR : '.$pui_id);
	}
}


public function contactedit(Request $req){
	// dd($req->contact_id);
$delete1 = DB::table('tbl_contact')->where('contact_id','=', $req->contact_id)->delete();
// dd($delete1);
if ($delete1)
{
	$contact_id = $req ->input ('contact_id');
	$contact_id_temp = $req ->input ('contact_id_temp');
	if ($contact_id == $contact_id_temp) {
		$contact_id_temp = $req ->input ('contact_id_temp');
	}else {
		$contact_id_temp = "";
	}
 $sat_id = $req ->input ('sat_id');
 $pui_id = $req ->input ('pui_id');
 $contact_id = $req ->input ('contact_id');
 $user_id = $req ->input ('user_id');
 $title_contact = $req ->input ('title_contact');
 $name_contact = $req ->input ('name_contact');
 $mname_contact = $req ->input ('mname_contact');
 $lname_contact = $req ->input ('lname_contact');
 $sex_contact = $req ->input ('sex_contact');
 $age_contact = $req ->input ('age_contact');
 $passport_contact = $req ->input ('passport_contact');
 $national_contact = $req ->input ('national_contact');
 $province = $req ->input ('province');
 $district = $req ->input ('district');
 $sub_district = $req ->input ('sub_district');
 $address_contact = $req ->input ('address_contact');
 $phone_contact = $req ->input ('phone_contact');
 $patient_contact = $req ->input ('patient_contact');
 $risk_contact = $req ->input ('risk_contact');
 $datecontact = $this->convertDateToMySQL($req ->input ('datecontact'));
 $datefollow = $this->convertDateToMySQL($req ->input ('datefollow'));
 $date_followup = $this->convertDateToMySQL($req ->input ('date_followup'));
 $type_contact = $req ->input ('type_contact');
 $province_follow_contact = $req ->input ('province_follow_contact');
 $division_follow_contact = $req ->input ('division_follow_contact');
 $division_follow_contact_other = $req ->input ('division_follow_contact_other');
 $sat_id_class = $req ->input ('sat_id_class');
 $hospcode = $req ->input ('hospcode');
 $clinical = $req ->input ('clinical');
 $fever = $req ->input ('fever');
 $cough = $req ->input ('cough');
 $sore_throat = $req ->input ('sore_throat');
 $mucous = $req ->input ('mucous');
 $sputum = $req ->input ('sputum');
 $breath_labored = $req ->input ('breath_labored');
 $suffocate = $req ->input ('suffocate');
 $muscle_aches = $req ->input ('muscle_aches');
 $headache = $req ->input ('headache');
 $diarrhea = $req ->input ('diarrhea');
 $status_followup = $req ->input ('status_followup');
 $available_contact = $req ->input ('available_contact');
 $follow_results = $req ->input ('follow_results');
 $date_entry = date('Y-m-d') ;
 $data = array(
	 // 'poe_id'=>$poe_id,
	 'sat_id'=>$sat_id,
	 'pui_id'=>$pui_id,
	 'contact_id'=>$contact_id,
	 'contact_id_temp'=>$contact_id_temp,
	 'title_contact'=>$title_contact,
	 'name_contact'=>$name_contact,
	 'mname_contact'=>$mname_contact,
	 'lname_contact'=>$lname_contact,
	 'sex_contact'=>$sex_contact,
	 'age_contact'=>$age_contact,
	 'passport_contact'=>$passport_contact,
	 'national_contact'=>$national_contact,
	 'province'=>$province,
	 'district'=>$district,
	 'sub_district'=>$sub_district,
	 'address_contact'=>$address_contact,
	 'phone_contact'=>$phone_contact,
	 'patient_contact'=>$patient_contact,
	 'risk_contact'=>$risk_contact,
	 'datecontact'=>$datecontact,
	 'datefollow'=>$datefollow,
	 'date_followup'=>$date_followup,
	 'type_contact'=>$type_contact,
	 'user_id'=>$user_id,
	 'province_follow_contact'=>$province_follow_contact,
	 'division_follow_contact'=>$division_follow_contact,
	 'division_follow_contact_other'=>$division_follow_contact_other,
	 'sat_id_class'=>$sat_id_class,
	 'hospcode'=>$hospcode,
	 'clinical'=>$clinical,
	 'fever'=>$fever,
	 'cough'=>$cough,
	 'sore_throat'=>$sore_throat,
	 'mucous'=>$mucous,
	 'sputum'=>$sputum,
	 'breath_labored'=>$breath_labored,
	 'suffocate'=>$suffocate,
	 'muscle_aches'=>$muscle_aches,
	 'headache'=>$headache,
	 'diarrhea'=>$diarrhea,
	 'status_followup'=>$status_followup,
	 'available_contact'=>$available_contact,
	 'follow_results'=>$follow_results,
	 'date_entry'=>$date_entry
 );
			// dd($data);
 $res1	= DB::table('tbl_contact')->insert($data);
//   if ($res1)
//   {
//     $dms_pcr_contact =$req ->input('dms_pcr_contact');
//     $dms_time_contact =$req ->input('dms_time_contact');
//     $dms_date_contact =$req ->input ('dms_date_contact');
// 		$dms_date_contact_s = str_replace('/', '-', $dms_date_contact);
// 		// $dms_date_contact_ss = date('Y-m-d', strtotime($dms_date_contact_s));
//     $dms_specimen_contact =$req ->input('dms_specimen_contact');
//     $chkspec_other_contact =$req ->input('chkspec_other_contact');
//     $other_pcr_result_contact =$req ->input('other_pcr_result_contact');
//      // exit;
//     // $date_entry =date('Y-m-d') ;
// $x=0;
//     for ($i=0; $i < count($dms_pcr_contact); $i++) {
//       $data_hsc[]  = [
//                  // 'no'=>$team_id[$i],
//                 // 'poe_id'=>$poe_id,
//                 'contact_id'=>$contact_id,
//                 'dms_pcr_contact'=>$dms_pcr_contact[$i],
//                 'dms_time_contact'=>$dms_time_contact[$i],
//                 'dms_date_contact'=>$dms_date_contact_s[$i],
//                 'dms_specimen_contact'=>$dms_specimen_contact[$i],
//                 'chkspec_other_contact' => $chkspec_other_contact[$i],
//                 'other_pcr_result_contact' => $other_pcr_result_contact[$i],
//                 'date_entry' => $date_entry
//               ];
//               $x++;
//             }
	 // dd($data_hsc);
	 // exit;
	 // $res3	= DB::table('tbl_contact_hsc')->insert($data_hsc);
// }
 if ($res1){

	 return redirect()->route('contacttable',[$pui_id])->with('message','Insert Success : '.$pui_id);
	}else{
	 return redirect()->route('contacttable',[$pui_id])->with('message','ERROR : '.$pui_id);
	 }
}
}

public function fetch(Request $request){
$id=$request->get('select');
$result=array();
$query=DB::table('ref_province')
->join('ref_district','ref_province.province_id','=','ref_district.province_id')
->select('ref_district.district_name','ref_district.district_id','ref_district.district_id')
->where('ref_province.province_id',$id)
->get();
$output='<option value="%">   อำเภอ   </option>';
	foreach ($query as $row) {
		$output.='<option value="'.$row->district_id.'">'.$row->district_name.'</option>';
	}
	echo $output;
}
public function fetchD(Request $request){
$idD = $request->select;
// dd($idD);
$resultD=array();
$queryD=DB::table('ref_sub_district')
->select('ref_sub_district.sub_district_name','ref_sub_district.sub_district_id','ref_sub_district.sub_district_id')
->where(DB::raw('left(ref_sub_district.sub_district_id, 4)'),'=',$idD)
->get();

$outputD='<option value="%">   ตำบล   </option>';
foreach ($queryD as $rowD) {
	$outputD.='<option value="'.$rowD->sub_district_id.'">'.$rowD->sub_district_name.'</option>';
}
echo $outputD;

}
  public function province(){
    $listprovince=DB::table('ref_province')
    ->orderBy('province_name', 'ASC')
    ->get();
     // return view('AEFI.Apps.form1')->with('list',$list);
     return $listprovince;
  }
	protected function arr_province(){
		$arr_province = DB::table('ref_province')->select('province_id','province_name')->get();
		foreach ($arr_province as  $value) {
			$arr_province[$value->province_id] =trim($value->province_name);
		}
		// dd($province_arr);
		return $arr_province;
	}
	protected function arrdistrict(){
		$arrdistrict = DB::table('ref_district')->select('district_id','district_name')->get();
		foreach ($arrdistrict as  $value) {
			$arrdistrict[$value->district_id] =trim($value->district_name);
		}
		// dd($province_arr);
		return $arrdistrict;
	}
	protected function arr_sub_district(){
		$arr_sub_district = DB::table('ref_sub_district')->select('sub_district_id','sub_district_name')->get();
		foreach ($arr_sub_district as  $value) {
			$arr_sub_district[$value->sub_district_id] =trim($value->sub_district_name);
		}
		// dd($province_arr);
		return $arr_sub_district;
	}
	protected function arr_hos(){
		$arr_hos = DB::table('chospital_new')->select('hospcode','hosp_name')->get();
		foreach ($arr_hos as  $value) {
			$arr_hos[$value->hospcode] =trim($value->hosp_name);
		}
		// dd($province_arr);
		return $arr_hos;
	}
	// public function ref_title_name(){
	// 	$ref_title_name=DB::table('ref_title_name')
	// 	->orderBy('id', 'ASC')
	// 	->get();
	// 	 // return view('AEFI.Apps.form1')->with('list',$list);
	// 	 return $ref_title_name;
	// }
	protected function arrnation(){
		$arrnation = DB::table('ref_global_country')->select('country_id','country_name')->get();
		foreach ($arrnation as  $value) {
			$arrnation[$value->country_id] =trim($value->country_name);
		}
		// dd($province_arr);
		return $arrnation;
	}
	protected function arroccu(){
		$arroccu = DB::table('ref_occupation')->select('id','occu_name_th')->get();
		foreach ($arroccu as  $value) {
			$arroccu[$value->id] =trim($value->occu_name_th);
		}
		// dd($province_arr);
		return $arroccu;
	}


	protected function arrsymptoms(){
		$arrsymptoms = DB::table('ref_symptoms')->select('id','symptom_name_en')->get();
		foreach ($arrsymptoms as  $value) {
			$arrsymptoms[$value->id] =trim($value->symptom_name_en);
		}
		// dd($province_arr);
		return $arrsymptoms;
	}
	protected function arrprov(){
		$arrprov = DB::table('ref_province')->select('province_id','province_name')->get();
		foreach ($arrprov as  $value) {
			$arrprov[$value->province_id] =trim($value->province_name);
		}
		// dd($province_arr);
		return $arrprov;
	}

	protected function arrspecimen(){
		$arrspecimen = DB::table('ref_specimen')->select('id','name_en')->get();
		foreach ($arrspecimen as  $value) {
			$arrspecimen[$value->id] =trim($value->name_en);
		}
		// dd($province_arr);
		return $arrspecimen;
	}
	// protected function arrtitlename(){
	// 	$arrtitlename = DB::table('ref_title_name')->select('id','title_name')->get();
	// 	foreach ($arrtitlename as  $value) {
	// 		$arrtitlename[$value->id] =trim($arrtitlename->title_name);
	// 	}
	// 	// dd($province_arr);
	// 	return $arrtitlename;
	// }
	protected function arrfollowup_address(){
		$arrfollowup_address = DB::table('ref_specimen')->select('id','name_en')->get();
		foreach ($arrfollowup_address as  $value) {
			$arrfollowup_address[$value->id] =trim($value->name_en);
		}
		// dd($province_arr);
		return $arrspecimen;
	}
	protected function arr_division_follow_contact(){
		$arr_division_follow_contact = array(
			'99'=>'ส่วนกลาง',
			'13'=>'สปคม.',
			'1'=>'สคร.1',
			'2'=>'สคร.2',
			'3'=>'สคร.3',
			'4'=>'สคร.4',
			'5'=>'สคร.5',
			'6'=>'สคร.6',
			'7'=>'สคร.7',
			'8'=>'สคร.8',
			'9'=>'สคร.9',
			'10'=>'สคร.10',
			'11'=>'สคร.11',
			'12'=>'สคร.12',
			'999'=>'อื่นๆ',
			''=>''
			);
		// dd($list_sym_cough);
		return $arr_division_follow_contact;
	}
	protected function arr_risk_contact(){
		$arr_risk_contact = array(
			'1'=>'เสี่ยงสูง',
			'2'=>'เสี่ยงต่ำ',
			'0'=>'',
			''=>''
			);
		// dd($list_sym_cough);
		return $arr_risk_contact;
	}
	protected function arr_type_contact(){
		$arr_type_contact = array(
			'1'=>'บุคลากรทางการแพทย์',
			'2'=>'ผู้สัมผัสร่วมบ้าน',
			'3'=>'ผู้ร่วมเดินทาง',
			'4'=>'พนักงานโรงแรม',
			'5'=>'คนขับแท๊กซี่/ยานพาหนะ',
			'6'=>'พนักงานสนามบิน',
			'7'=>'อื่นๆ',
			''=>''
			);
		// dd($list_sym_cough);
		return $arr_type_contact;
	}
	protected function arr_status_followup(){
		$arr_status_followup = array(
			'1'=>'จบการติดตาม',
			'2'=>'ยังต้องติดตาม',
			''=>''
			);
		// dd($list_sym_cough);
		return $arr_status_followup;
	}
	protected function arr_available_contact(){
		$arr_available_contact= array(
			'1'=>'ติดตามได้',
			'2'=>'ติดตามไม่ได้',
			''=>''
			);
		// dd($list_sym_cough);
		return $arr_available_contact;
	}
	protected function arr_follow_results(){
		$arr_follow_results= array(
			'1'=>'ไม่มี',
			'2'=>'เล็กน้อย',
			'3'=>'หนัก',
			'4'=>'วิกฤต',
			''=>''
			);
		// dd($list_sym_cough);
		return $arr_follow_results;
	}
	protected function arrtitlename(){
			$arrtitlename = DB::table('ref_title_name')->select('id','title_name')->get();
			foreach ($arrtitlename as  $value) {
				$arrtitlename[$value->id] = trim($value->title_name);
			}
			 // dd($disease_arr_eventbase);
			return $arrtitlename;
		}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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


		public function fetchos(Request $request){
		$id=$request->get('select');
		$result=array();
		$query=DB::table('ref_province')
		->join('chospital_new','ref_province.province_id','=','chospital_new.prov_code')
		->select('chospital_new.hospcode','chospital_new.hosp_name','chospital_new.prov_code')
		->where('ref_province.province_id',$id)
		->where('chospital_new.status_code','=',1)
		->get();
		$output='<option value="%">   โรงพยาบาล   </option>';
			foreach ($query as $row) {
				$output.='<option value="'.$row->hospcode.'">'.$row->hosp_name.'</option>';
			}
			echo $output;
		}

}

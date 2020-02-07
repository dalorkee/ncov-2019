<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use Carbon\Carbon;

class ContactController extends MasterController
{
  // allcontact table
	public function allcasecontacttable(Request $req)
  {
		$contact_data=DB::table('tbl_contact')->select('*')->get();
    return view('form.contact.allcasecontacttable',compact(
			'contact_data'
    ));
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
		$sat_id=$req->sat_id;
		// dd($poe_id);
		$patian_data=DB::table('invest_pt')->select('*')->where('sat_id', [$req->sat_id] )->get();
		$contact_data=DB::table('tbl_contact')->select('*')->where('sat_id', $sat_id)->get();
    return view('form.contact.contacttable',compact(
			'contact_data',
			'patian_data'
    ));
  }


  public function contactfollowtable(Request $req)
  {
		$sat_id=$req->sat_id;
		// $poe_id=$req->poe_id;
		$contact_id=$req->contact_id;
		$contact_id_day=$req->contact_id_day;
    return view('form.contact.contactfollowtable',compact(
			'sat_id',
			// 'poe_id',
			'contact_id_day',
			'contact_id'
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
																 'type_contact',)
												->where('contact_id',$contact_id)
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
														  ->where('sat_id',$sat_id)
															->get();
		$ref_detail_follow=DB::table('tbl_followupcontact')
            					->join('tbl_followupcontact_hsc', 'tbl_followupcontact.contact_id', '=', 'tbl_followupcontact_hsc.contact_id')
            					->select('tbl_followupcontact.*'
											, 'tbl_followupcontact_hsc.pcr_contact'
											, 'tbl_followupcontact_hsc.specimen_contact'
											, 'tbl_followupcontact_hsc.other_pcr_result_contact'
											, 'tbl_followupcontact_hsc.chkspec_other_contact')
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
		$ref_title_name=DB::table('ref_title_name')->select('*')->get();
		$ref_specimen=DB::table('ref_specimen')->select('*')->get();
		$ref_global_country=DB::table('ref_global_country')->select('country_id','country_name')->get();
		$sat_id=$req->sat_id;
    $listprovince=$this->province();
    $listcountry=$this->country();
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
			'entry_user'
    ));
	}
  public function followupcontact(Request $req)
  {
		$ref_title_name=DB::table('ref_title_name')->select('*')->get();
		$ref_specimen=DB::table('ref_specimen')->select('*')->get();
		$ref_global_country=DB::table('ref_global_country')->select('country_id','country_name')->get();
		$sat_id=$req->sat_id;
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
			'prefix_sat_id',
			'contact_id_day',
			'contact_id',
			'entry_user'
    ));
  }


  public function contactinsert(Request $req)
 {
	 // $contactid=uniqid();
  // $poe_id = $req ->input ('poe_id');
	$sat_id = $req ->input ('sat_id');
  // $contact_id = $poe_id.'_'.$contactid;	// dd($order);
		$user_id = $req ->input ('user_id');
	$contact_id = $req ->input ('contact_id');
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
  $type_contact = $req ->input ('type_contact');
	$province_follow_contact = $req ->input ('province_follow_contact');
	$division_follow_contact = $req ->input ('division_follow_contact');
	$division_follow_contact_other = $req ->input ('division_follow_contact_other');
	$sat_id_class = $req ->input ('sat_id_class');
  $date_entry = date('Y-m-d') ;
  $data = array(
    // 'poe_id'=>$poe_id,
		'sat_id'=>$sat_id,
    'contact_id'=>$contact_id,
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
    'type_contact'=>$type_contact,
		'user_id'=>$user_id,
		'province_follow_contact'=>$province_follow_contact,
		'division_follow_contact'=>$division_follow_contact,
		'division_follow_contact_other'=>$division_follow_contact_other,
		'sat_id_class'=>$sat_id_class,
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
    $msg = " ส่งข้อมูลสำเร็จ";
		// $poe_id=$poe_id;
    $url_rediect = "<script>alert('".$msg."'); window.location='contacttable?sat_id=$sat_id';</script> ";
  }else{
    $msg = " ส่งข้อมูลไม่สำเร็จ";
    $url_rediect = "<script>alert('".$msg."'); window.location='contacttable?sat_id=$sat_id';</script> ";
    }
    echo $url_rediect;
}

public function followupcontactinsert(Request $req)
{
// $poe_id = $req ->input ('poe_id');
$sat_id = $req ->input ('sat_id');
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
$division_follow_contact = $req ->input ('division_follow_contact');
$division_follow_contact_other = $req ->input ('division_follow_contact_other');
$sat_id_class = $req ->input ('sat_id_class');
$date_entry = date('Y-m-d') ;
$data = array(
	// 'poe_id'=>$poe_id,
	'sat_id'=>$sat_id,
	'contact_id'=>$contact_id,
	'contact_id_day'=>$contact_id_day,
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
	$msg = " ส่งข้อมูลสำเร็จ";
	$url_rediect = "<script>alert('".$msg."'); window.location='contactfollowtable?sat_id=$sat_id&contact_id=$contact_id';</script> ";
}else{
	$msg = " ส่งข้อมูลไม่สำเร็จ";
	$url_rediect = "<script>alert('".$msg."'); window.location='contactfollowtable?sat_id=$sat_id&contact_id=$contact_id';</script> ";
	}
	echo $url_rediect;
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
	public function country(){
		$listprovince=DB::table('ref_global_country')
		->orderBy('country_name', 'ASC')
		->get();
		 // return view('AEFI.Apps.form1')->with('list',$list);
		 return $listprovince;
	}
	public function ref_title_name(){
		$ref_title_name=DB::table('ref_title_name')
		->orderBy('id', 'ASC')
		->get();
		 // return view('AEFI.Apps.form1')->with('list',$list);
		 return $ref_title_name;
	}
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
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class ContactController extends MasterController
{
  // allcontact table
	public function allcasecontacttable(Request $req)
  {
		// dd($poe_id);
		$contact_data=DB::table('tbl_contact')->select('*')->get();
    return view('form.contact.allcasecontacttable',compact(
			'contact_data'
    ));
  }
  // indexcontact table
  public function contacttable(Request $req)
  {
		$poe_id=$req->poe_id;
		// dd($poe_id);
		$patian_data=DB::table('invest_pt')->select('*')->where('poe_id', [$req->poe_id] )->get();
		$contact_data=DB::table('tbl_contact')->select('*')->where('poe_id', $poe_id)->get();
    return view('form.contact.contacttable',compact(
			'contact_data',
			'patian_data'
    ));
  }
  public function contactfollowtable(Request $req)
  {
		$inv_id=$req->inv_id;
		$poe_id=$req->poe_id;
		$contact_id=$req->contact_id;
		$contact_id_day=$req->contact_id_day;
    return view('form.contact.contactfollowtable',compact(
			'inv_id',
			'poe_id',
			'contact_id_day',
			'contact_id'
    ));
  }
	// form contact add
	public function detailcontact(Request $req)
	{
		$ref_title_name=DB::table('ref_title_name')->select('*')->get();
		$ref_specimen=DB::table('ref_specimen')->select('*')->get();
		$ref_global_country=DB::table('ref_global_country')->select('country_id','country_name')->get();
		$inv_id=$req->inv_id;
		$listprovince=$this->province();
		$listcountry=$this->country();
		return view('form.contact.detailcontact',compact(
			'listprovince',
			'listcountry',
			'ref_title_name',
			'ref_specimen',
			'ref_global_country',
			'inv_id'
		));
	}
  // form contact add
  public function addcontact(Request $req)
	{
		$ref_title_name=DB::table('ref_title_name')->select('*')->get();
		$ref_specimen=DB::table('ref_specimen')->select('*')->get();
		$ref_global_country=DB::table('ref_global_country')->select('country_id','country_name')->get();
		$inv_id=$req->inv_id;
    $listprovince=$this->province();
    $listcountry=$this->country();
		return view('form.contact.addcontact',compact(
      'listprovince',
      'listcountry',
			'ref_title_name',
			'ref_specimen',
			'ref_global_country',
			'inv_id'
    ));
	}
  public function followupcontact(Request $req)
  {
		$ref_title_name=DB::table('ref_title_name')->select('*')->get();
		$ref_specimen=DB::table('ref_specimen')->select('*')->get();
		$ref_global_country=DB::table('ref_global_country')->select('country_id','country_name')->get();
		$inv_id=$req->inv_id;
		$contact_id=$req->contact_id;
		$contact_id_day=$req->contact_id_day;
    $listprovince=$this->province();
    $listcountry=$this->country();
    return view('form.contact.followupcontact',compact(
      'listprovince',
      'listcountry',
			'ref_title_name',
			'ref_specimen',
			'ref_global_country',
			'inv_id',
			'contact_id_day',
			'contact_id'
    ));
  }
  public function contactinsert(Request $req)
 {
	 // $contactid=uniqid();
  $poe_id = $req ->input ('poe_id');
	$inv_id = $req ->input ('inv_id');
  // $contact_id = $poe_id.'_'.$contactid;	// dd($order);
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
  $routing_contact = $req ->input ('routing_contact');
  $available_contact = $req ->input ('available_contact');
  $date_entry = date('Y-m-d') ;
  $data = array(
    'poe_id'=>$poe_id,
		'inv_id'=>$inv_id,
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
    'routing_contact'=>$routing_contact,
    'available_contact'=>$available_contact,
    'date_entry'=>$date_entry
  );
     // dd($data);
  $res1	= DB::table('tbl_contact')->insert($data);
  if ($res1)
  {
    $dms_pcr_contact =$req ->input('dms_pcr_contact');
    $dms_time_contact =$req ->input('dms_time_contact');
    $dms_date_contact =$req ->input ('dms_date_contact');
		$dms_date_contact_s = str_replace('/', '-', $dms_date_contact);
		// $dms_date_contact_ss = date('Y-m-d', strtotime($dms_date_contact_s));
    $dms_specimen_contact =$req ->input('dms_specimen_contact');
    $chkspec_other_contact =$req ->input('chkspec_other_contact');
    $other_pcr_result_contact =$req ->input('other_pcr_result_contact');
     // exit;
    // $date_entry =date('Y-m-d') ;
$x=0;
    for ($i=0; $i < count($dms_pcr_contact); $i++) {
      $data_hsc[]  = [
                 // 'no'=>$team_id[$i],
                'poe_id'=>$poe_id,
                'contact_id'=>$contact_id,
                'dms_pcr_contact'=>$dms_pcr_contact[$i],
                'dms_time_contact'=>$dms_time_contact[$i],
                'dms_date_contact'=>$dms_date_contact_s[$i],
                'dms_specimen_contact'=>$dms_specimen_contact[$i],
                'chkspec_other_contact' => $chkspec_other_contact[$i],
                'other_pcr_result_contact' => $other_pcr_result_contact[$i],
                'date_entry' => $date_entry
              ];
              $x++;
            }
    // dd($data_hsc);
    // exit;
    $res3	= DB::table('tbl_contact_hsc')->insert($data_hsc);
}
  if ($data_hsc){
    $msg = " ส่งข้อมูลสำเร็จ";
		$poe_id=$poe_id;
    $url_rediect = "<script>alert('".$msg."'); window.location='contacttable?poe_id=$poe_id';</script> ";
  }else{
    $msg = " ส่งข้อมูลไม่สำเร็จ";
    $url_rediect = "<script>alert('".$msg."'); window.location='contacttable?poe_id=$poe_id';</script> ";
    }
    echo $url_rediect;
}

public function followupcontactinsert(Request $req)
{
$poe_id = $req ->input ('poe_id');
$inv_id = $req ->input ('inv_id');
$contact_id = $req ->input ('contact_id');
$contact_id_day= $req ->input ('contact_id_day');
$date_no = $this->convertDateToMySQL($req ->input ('date_no'));
$clinical_mers = $req ->input ('clinical_mers');
$fever_mers = $req ->input ('fever_mers');
$cough_mers = $req ->input ('cough_mers');
$sore_throat_mers = $req ->input ('sore_throat_mers');
$mucous_mers = $req ->input ('mucous_mers');
$sputum_mers = $req ->input ('sputum_mers');
$breath_labored_mers = $req ->input ('breath_labored_mers');
$suffocate_mers = $req ->input ('suffocate_mers');
$muscle_aches_mers = $req ->input ('muscle_aches_mers');
$headache_mers = $req ->input ('headache_mers');
$diarrhea_mers = $req ->input ('diarrhea_mers');
$other_symtom_mers = $req ->input ('other_symtom_mers');
$date_entry = date('Y-m-d') ;
$data = array(
	'poe_id'=>$poe_id,
	'inv_id'=>$inv_id,
	'contact_id'=>$contact_id,
	'contact_id_day'=>$contact_id_day,
	'date_no'=>$date_no,
	'clinical_mers'=>$clinical_mers,
	'fever_mers'=>$fever_mers,
	'cough_mers'=>$cough_mers,
	'sore_throat_mers'=>$sore_throat_mers,
	'mucous_mers'=>$mucous_mers,
	'sputum_mers'=>$sputum_mers,
	'breath_labored_mers'=>$breath_labored_mers,
	'suffocate_mers'=>$suffocate_mers,
	'muscle_aches_mers'=>$muscle_aches_mers,
	'headache_mers'=>$headache_mers,
	'diarrhea_mers'=>$diarrhea_mers,
	'other_symtom_mers'=>$other_symtom_mers,
	'date_entry'=>$date_entry
);
  // dd($data);
$res1	= DB::table('tbl_followupcontact')->insert($data);
if ($res1)
{
	$pcr_contact =$req ->input('pcr_contact');
	$specimen_contact =$req ->input('specimen_contact');
	$chkspec_other_contact =$req ->input('chkspec_other_contact');
	$other_pcr_result_contact =$req ->input('other_pcr_result_contact');
	 // exit;
	// $date_entry =date('Y-m-d') ;
$x=0;
	for ($i=0; $i < count($pcr_contact); $i++) {
		$data_hsc[]  = [
							 // 'no'=>$team_id[$i],
							 'poe_id'=>$poe_id,
							'inv_id'=>$inv_id,
							'contact_id'=>$contact_id,
							'contact_id_day'=>$contact_id_day,
							'pcr_contact'=>$pcr_contact[$i],
							'specimen_contact'=>$specimen_contact[$i],
							'chkspec_other_contact'=>$chkspec_other_contact[$i],
							'other_pcr_result_contact'=>$other_pcr_result_contact[$i],
							'date_entry' => $date_entry
						];
						$x++;
					}
	// dd($ddata_member);
	// exit;
	$res3	= DB::table('tbl_followupcontact_hsc')->insert($data_hsc);
}
if ($data_hsc){
	$msg = " ส่งข้อมูลสำเร็จ";
	$url_rediect = "<script>alert('".$msg."'); window.location='contactfollowtable?poe_id=$poe_id&contact_id=$contact_id';</script> ";
}else{
	$msg = " ส่งข้อมูลไม่สำเร็จ";
	$url_rediect = "<script>alert('".$msg."'); window.location='contactfollowtable?poe_id=$poe_id&contact_id=$contact_id';</script> ";
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
	public function ref_title_name(){
		$ref_title_name=DB::table('ref_title_name')
		->orderBy('id', 'ASC')
		->get();
		 // return view('AEFI.Apps.form1')->with('list',$list);
		 return $ref_title_name;
	}
  public function country(){
    $listcountry=DB::table('ref_nationality')
    ->orderBy('name_en', 'ASC')
    ->get();
     // return view('AEFI.Apps.form1')->with('list',$list);
     return $listcountry;
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

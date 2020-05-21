<?php

namespace App\Exports;
use DB;
use App\Provinces;
use App\District;
use App\SubDistrict;
use App\GlobalCountry;
use App\laboratory;
use Illuminate\Http\Request;
use App\LabContactLists;
use App\ContactList;
use App\LaboratoryLists;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
class ContactExport  implements FromCollection, WithHeadings
{
  private $id;
  public function __construct($id) {
    $this->id = $id;
  }
    public function collection()
    {
      $arr_risk_contact = array('1'=>'เสี่ยงสูง','2'=>'เสี่ยงต่ำ','0'=>'',''=>'');
      $arr_type_contact = array(
        ''=>'',
      '10'  =>'บุคคลในครอบครัวไม่ระบุประเภท'	,
      '11'  =>'บิดา/มารดา',
      '13'  =>'บุตร'	,
      '14'  =>'สามี/ภรรยา'	,
      '16'  =>'ญาติ'	,
      '17'  =>'เพื่อน'	,
      '20'  =>'บุคคลร่วมเดินทางไม่ระบุประเภท'	,
      '21'  	=>'บุคคลร่วมกรุ๊ฟทัวร์' ,
      '22'  =>'บคคลร่วมโดยสารเครื่องบิน'	,
      '23'  =>'บุคคลร่วมTaxi/Grab'	,
      '24'  	=>'บุคคลร่วมรถประจำทาง' ,
      '25'  =>'บุคคลร่วมรถตู้โดยสาร'	,
      '26'  =>'บุคคลร่วมรถส่วนตัว'	,
      '31'  =>'เจ้าหน้าที่สนามบิน/เจ้าหน้าที่เครื่องบิน'	,
      '32'  	=>'เพื่อนร่วมทำงาน',
      '33'  =>'บุคคลร่วมโรงเรียน/สถานศึกษา'	,
      '34'  =>'บุคคลร่วมเรือนจำ'	,
      '40'  =>'บุคลากรทางการแพทย์ไม่ระบุประเภท'	,
      '41'  =>'แพทย์'	,
      '42'  =>'พยาบาล'	,
      '43'  =>'เจ้าหน้าที่ห้องปฏิบัติการ'	,
      '45'  =>'ผู้ป่วยร่วมบริเวณ'	,
      '51'  =>'บุคคลร่วมหอพัก'	,
      '52'  =>'บุคคลร่วมโรงแรม/คอนโด'	,
      '54'  =>'บุคคลที่พักอื่นๆ'	,
      '55'  =>'บุคคลร่วมชุมชน'	,
      '56'  =>'บุคคลร่วมพื้นที่กักกัน'	,
      '61'  =>'บุคคลร่วมสถานที่สาธารณะ เช่น ห้าง ตลาด'	,
      '62'  =>'บุคคลร่วมงานประชุม/สัมมนา'	,
      '63'  =>'บุคคลร่วมศาสนาพิธี'	,
      '64'  =>'บุคคลร่วมร้านอาหาร'	,
      '65'  =>'บุคคลร่วมกิจกรรมท่องเที่ยว'	,
      '66'  =>'บุคคลร่วมชม/แข่งขันกีฬา'	,
      '99'  =>'อื่นๆ'	,
        );
      $arr_status_followup = array('1'=>'จบการติดตาม','2'=>'ยังต้องติดตาม',''=>'');
      $arr_province = Provinces::all()->keyBy('province_id')->toArray();
      $arr_district = District::all()->keyBy('district_id')->toArray();
      $arr_sub_district = SubDistrict::all()->keyBy('sub_district_id')->toArray();
      $arr_national_contact = GlobalCountry::all()->keyBy('country_id')->toArray();
      $arr_laboratory_name = LaboratoryLists::all()->keyBy('id')->toArray();
      $arr_labstation_contact1 = LabContactLists::all()->where('no_lab', '=','1')->keyBy('contact_id')->toArray();
      $arr_labstation_contact2 = LabContactLists::all()->where('no_lab', '=','2')->keyBy('contact_id')->toArray();
      $contact_data= DB::table('patient_relation')
  										->join('tbl_contact', 'patient_relation.contact_rid', '=', 'tbl_contact.id')
  										->select(
  															'patient_relation.sat_id',
  															'patient_relation.contact_id',
                                'tbl_contact.name_contact',
                                'tbl_contact.mname_contact',
                                'tbl_contact.lname_contact',
  															'tbl_contact.age_contact',
  															'tbl_contact.sex_contact',
  															'tbl_contact.phone_contact',
  															'tbl_contact.national_contact',
  															'tbl_contact.province',
  															'tbl_contact.district',
  															'tbl_contact.sub_district',
                                'tbl_contact.sick_house_no',
                                'tbl_contact.sick_village_no',
                                'tbl_contact.sick_village',
                                'tbl_contact.sick_lane',
                                'tbl_contact.sick_road',
                                'tbl_contact.patient_contact',
                                'tbl_contact.risk_contact',
                                'tbl_contact.datecontact',
                                'tbl_contact.type_contact',
                                'tbl_contact.status_followup',
  															'tbl_contact.pt_status')
  										->where('patient_relation.pui_id','=', $this->id)
  										->whereNull('delete_at')
  										->get()->toArray();
      	$result = collect();
        $arr_lab_contact1 = DB::table('tbl_contact_hsc')
                          ->select('dms_pcr_contact','contact_id','id')
                          ->where('no_lab',  '=',"1")
                          ->where('pui_id',  '=', $this->id)
                          ->get();
        // dd($arr_lab_contact1);
        foreach($contact_data as  $value) {
          if (!empty($value->national_contact) || $value->national_contact != null) {
            $national_contact = $arr_national_contact[$value->national_contact]['country_name'];
          } else {
            $national_contact= '-';
          }
          if (!empty($value->province) || $value->province != null) {
            $province = $arr_province[$value->province]['province_name'];
          } else {
            $province= '-';
          }
          if (!empty($value->district) || $value->district != null) {
            $district = $arr_district[$value->district]['district_name'];
          } else {
            $district= '-';
          }
          if (!empty($value->sub_district) || $value->sub_district != null) {
            $sub_district = $arr_sub_district[$value->sub_district]['sub_district_name'];
          } else {
            $sub_district = '-';
          }
          if (!empty($value->contact_id) || $value->contact_id != null) {
            if ($value->contact_id == 'Code_BIDI' || $value->contact_id == '' || $value->contact_id!=$arr_labstation_contact1) {
              $lab1_name = "";
            }
            else {
                $lab1_name = $arr_labstation_contact1[$value->contact_id]['dms_pcr_contact'] ;
            }
          } else {
            $lab1_name = '-';
          }
          if (!empty($lab1_name) || $lab1_name != null ) {
            if ($lab1_name == '-' ||$lab1_name == '46' || $lab1_name == "Code_BIDI")  {
              $lab1 = '-';
            }else {
              $lab1 = $arr_laboratory_name[$lab1_name]['th_name'] ;
            }
          } else {
            $lab1= '-';
          }
            // dd($lab1);
          if (!empty($value->contact_id) || $value->contact_id != null || $value->contact_id != "Code_BIDI") {
            if ($value->contact_id == 'Code_BIDI' || $value->contact_id!=$arr_labstation_contact2) {
              $lab2_name = "";
            }else {
                  $lab2_name = $arr_labstation_contact2[$value->contact_id]['dms_pcr_contact'] ;
            }
          } else {
            $lab2_name = '-';
          }
          if (!empty($lab2_name) || $lab2_name != null ) {
            if ($lab2_name == '-' ||$lab2_name == '46' || $lab2_name == "Code_BIDI" || $lab2_name == "")  {
              $lab2= '-';
            }else {
                $lab2 = $arr_laboratory_name[$lab2_name]['th_name'] ;
            }

          } else {
            $lab2= '-';
          }
          if (!empty($value->contact_id) || $value->contact_id != null) {
            if ($value->contact_id == 'Code_BIDI' || $value->contact_id == '' || $value->contact_id!=$arr_labstation_contact1) {
              $labresult1 = "-";
            }else{
                $labresult1 = $arr_labstation_contact1[$value->contact_id]['other_pcr_result_contact'] ;
            }
          } else {
            $labresult1 = '-';
          }
          if (!empty($value->contact_id) || $value->contact_id != null) {
            if ($value->contact_id == 'Code_BIDI' || $value->contact_id!=$arr_labstation_contact2) {
              $labresult2 = "-";
            }else {
                $labresult2 = $arr_labstation_contact2[$value->contact_id]['other_pcr_result_contact'] ;
            }
          } else {
            $labresult2 = '-';
          }
          if (!empty($value->risk_contact) || $value->risk_contact != null) {
            $risk_contact= $arr_risk_contact[$value->risk_contact];
          } else {
            $risk_contact = '-';
          }
          if (!empty($value->type_contact) || $value->type_contact != null) {
            // $type_contact= $arr_type_contact[$value->type_contact];
            $type_contact= $arr_type_contact[$value->type_contact];
          } else {
            $type_contact = '-';
          }
          if (!empty($value->status_followup) || $value->status_followup != null) {
            $status_followup= $arr_status_followup[$value->status_followup];
          } else {
            $status_followup = '-';
          }
          // if (!empty($value->contact_id) || $value->contact_id != null) {
          //       // $arr_pt_status_detail = $value->contact_id ;
          //       if ($value->contact_id == 'Code_BIDI' || $value->contact_id == '' || $value->contact_id != $arr_pt_status_detail) {
          //         $pt_status_detail = "-";
          //       }else{
          //           $pt_status_detail = $arr_pt_status_detail[$value->contact_id]['pt_status'] ;
          //       }
          // } else {
          //   $pt_status_detail= '-';
          // }
          $arr = array(
            'sat_id' => $value->sat_id,
            'contact_id' => $value->contact_id,
            'name_contact' => $value->name_contact,
            'mname_contact' => $value->mname_contact,
            'lname_contact' => $value->lname_contact,
            'age_contact' => $value->age_contact,
            'sex_contact' => $value->sex_contact,
            'phone_contact' => $value->phone_contact,
            'national_contact' => $national_contact,
            'province' => $province,
            'district' => $district,
            'sub_district' => $sub_district,
            'sick_house_no' => $value->sick_house_no,
            'sick_village_no' => $value->sick_village_no,
            'sick_village' => $value->sick_village,
            'sick_lane' => $value->sick_lane,
            'sick_road' => $value->sick_road,
            'patient_contact' => $value->patient_contact,
            'risk_contact' => $risk_contact,
            'datecontact' => $value->datecontact,
            'type_contact' => $type_contact,
            'status_followup' => $status_followup,
            'pt_status'=> $value->pt_status,
            'lab1' =>  $lab1,
            'labresult1'=> $labresult1,
            'lab2' => $lab2,
            'labresult2'=> $labresult2
          );
          $result->push($arr);
        }
        return $result;
    }
    public function headings(): array {
      return [
        'SAT ID',
        'Contact ID',
        'ชื่อผู้สัมผัส',
        'ชื่อกลางผู้สัมผัส',
        'นามสกุลผู้สัมผัส',
        'อายุ',
        'เพศ',
        'เบอร์โทรศัพท์',
        'สัญชาติ',
        'จังหวัดที่อยู่',
        'อำเภอ',
        'ตำบล',
        'บ้านเลขที่',
        'ที่อยู่',
        'หมู่บ้าน',
        'ซอย',
        'ถนน',
        'การสัมผัส',
        'ระดับความเสี่ยง',
        'วันที่สัมผัส',
        'ประเภทผู้สัมผัส',
        'สถานะการติดตาม',
        'สถานะผู้ป่วย',
        'สถานที่ส่งตรวจตัวอย่าง1',
        'ผลการตรวจ1',
        'สถานที่ส่งตรวจตัวอย่าง2',
        'ผลการตรวจ2',
      ];
    }
}

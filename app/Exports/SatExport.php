<?php

namespace App\Exports;
use App\invest;
use DB;
use App\Provinces;
use App\District;
use App\SubDistrict;
use App\GlobalCountry;
use App\laboratory;
use App\Hospitals;
use App\GlobalCity;
use App\AirportLists;
use App\Occupation;
use App\RiskType;
use Illuminate\Http\Request;
use App\LaboratoryLists;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
class SatExport  implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    private $data;
    public function __construct($data) {
      $this->new_status = array_pull($data, 'new_status');
      $this->notify_date_end = array_pull($data, 'notify_date_end');
      $this->notify_date = array_pull($data, 'notify_date');
       // dd($this->new_status);
    }
    public function collection()
    {
      // dd($this->notify_date);
        $arr_province = Provinces::all()->keyBy('province_id')->toArray();
        $arr_district = District::all()->keyBy('district_id')->toArray();
        $arr_sub_district = SubDistrict::all()->keyBy('sub_district_id')->toArray();
        $arr_national = GlobalCountry::all()->keyBy('country_id')->toArray();
        $arr_hospital = Hospitals::all()->keyBy('hospcode')->toArray();
        $arr_airport = AirportLists::all()->keyBy('list')->toArray();
        $arr_occupation = Occupation::all()->keyBy('id')->toArray();
        $arr_city = GlobalCity::all()->keyBy('city_id')->toArray();
        $arr_risk_type = RiskType::all()->keyBy('id')->toArray();
        $arr_pui_type = array(
                                    '1'=>'New PUI',
                                    '2'=>'Contact PUI',
                                    '3'=>'PUO',
                                    '4'=>'Confirm nCov 2019',
                                    ''=>''
                                    );
        $arr_news_st = array(
                                    '1'=>'Confirmed publish',
                                    '2'=>'Confirmed not yet released',
                                      );
        $arr_pt_status = array(
                                    '1'=>'PUI (รอผลแลป)',
                          					'2'=>'Confirmed (ผลแลปยืนยัน)',
                          					'5'=>'Excluded (ผลแลปเป็นลบ)',
                                      );
        $arr_disch_st = array(

                                    '1'=>'Recovered',
                                    '2'=>'Admitted',
                                    '3'=>'Death',
                                    '4'=>'Self quarantine',
                                      );
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
        $data=
        DB::table('invest_pt')->select('id',
                        'order_pt',
                        'sat_id',
                        'first_name',
                        'mid_name',
                        'last_name',
                        'notify_date',
                        'walkinplace_hosp_code',
                        'airports_code',
                        'walkinplace_hosp_province',
                        'isolated_province',
                        'isolated_hosp_code',
                        'travel_from_country',
                        'travel_from_city',
                        'risk_stay_outbreak_arrive_date',
                        'risk_stay_outbreak_airline',
                        'risk_stay_outbreak_flight_no',
                        'total_travel_in_group',
                        'risk_stay_outbreak_arrive_date',
                        'risk_stay_outbreak_airline',
                        'risk_stay_outbreak_flight_no',
                        'total_travel_in_group',
                        'sex',
                        'age',
                        'nation',
                        'occupation',
                        'occupation_oth',
                        'sick_house_no',
                        'sick_village_no',
                        'sick_village',
                        'sick_lane',
                        'sick_road',
                        'sick_province',
                        'sick_district',
                        'sick_sub_district',
                        'data3_3chk_lung',
                        'data3_3chk_heart',
                        'data3_3chk_cirrhosis',
                        'data3_3chk_kidney',
                        'data3_3chk_diabetes',
                        'data3_3chk_blood',
                        'data3_3chk_immune',
                        'data3_3chk_anaemia',
                        'data3_3chk_cerebral',
                        'data3_3input_other',
                        'data3_3chk_pregnant',
                        'data3_3chk_fat',
                        'data3_3chk_cancer_name',
                        'risk_detail',
                        'risk_type',
                        'data3_1date_sickdate',
                        'isolate_date',
                        'fever_history',
                        'fever_current',
                        'sym_cough',
                        'sym_snot',
                        'sym_sore',
                        'sym_dyspnea',
                        'sym_breathe',
                        'sym_stufefy',
                        'xray_result',
                        'lab_rapid_test_result',
                        'first_diag',
                        'last_diag',
                        'letter_division_code',
                        'letter_code',
                        'refer_lab',
                        'refer_bidi',
                        'op_dpc',
                        'op_opt',
                        'pt_status',
                        'pui_type',
                        'news_st',
                        'disch_st',
                        'disch_st_date',
                        'coordinator_tel',
                        'send_information',
                        'send_information_div',
                        'receive_information',
                      )
              ->wherein('pt_status',$this->new_status)
              ->whereBetween('notify_date', [$this->notify_date, $this->notify_date_end])
              ->whereNull('deleted_at')
              ->get()->toArray();
              // dd($data);
          		$result = collect();
          		foreach($data as $value) {
                  if (!empty($value->nation) || $value->nation != null) {
                    $nation = $arr_national[$value->nation]['country_name'];
                  } else {
                    $nation= '-';
                  }
                  if (!empty($value->walkinplace_hosp_province) || $value->walkinplace_hosp_province != null || $value->walkinplace_hosp_province != 0) {
                    $walkinplace_hosp_province = $arr_province[$value->walkinplace_hosp_province]['province_name'];
                  } else {
                    $walkinplace_hosp_province= '-';
                  }
                  if (!empty($value->sick_province) || $value->sick_province != null) {
                    $sick_province = $arr_province[$value->sick_province]['province_name'];
                  } else {
                    $sick_province = '-';
                  }
                  if (!empty($value->sick_district) || $value->sick_district != null) {
                    $sick_district = $arr_district[$value->sick_district]['district_name'];
                  } else {
                    $sick_district = '-';
                  }
                  if (!empty($value->sick_sub_district) || $value->sick_sub_district != null) {
                    $sick_sub_district = $arr_sub_district[$value->sick_sub_district]['sub_district_name'];
                  }elseif ($value->sick_sub_district == 0) {
                    $sick_district = '-';
                  }
                   else {
                    $sick_district = '-';
                  }
                  if (!empty($value->walkinplace_hosp_code) || $value->walkinplace_hosp_code != null) {
                    $walkinplace_hosp_code = $arr_hospital[$value->walkinplace_hosp_code]['hosp_name'];
                  } else {
                    $walkinplace_hosp_code = '-';
                  }
                  if (!empty($value->airports_code) || $value->airports_code != null) {
                    $airports_code = $arr_airport[$value->airports_code]['right'];
                  } else {
                    $airports_code = '-';
                  }
                  if (!empty($value->isolated_province) || $value->isolated_province != null) {
                    $isolated_province = $arr_province[$value->isolated_province]['province_name'];
                  } else {
                    $isolated_province= '-';
                  }
                  if (!empty($value->isolated_hosp_code) || $value->isolated_hosp_code != null) {
                    $isolated_hosp_code = $arr_hospital[$value->isolated_hosp_code]['hosp_name'];
                  } else {
                    $isolated_hosp_code= '-';
                  }
                  // if (!empty($value->risk2_6history_hospital_input) || $value->risk2_6history_hospital_input != null) {
                  //   $risk2_6history_hospital_input = $value->risk2_6history_hospital_input;
                  // } else {
                  //   $risk2_6history_hospital_input = '-';
                  // }
                  if (!empty($value->travel_from_country) || $value->travel_from_country != null|| $value->travel_from_country != 0) {
                    $travel_from_country = $arr_national[$value->travel_from_country]['country_name'];
                  } else {
                    $travel_from_country = '-';
                  }
                  if (!empty($value->travel_from_city) || $value->travel_from_city != null) {
                    $travel_from_city = $arr_city[$value->travel_from_city]['city_name'];
                  } else {
                    $travel_from_city = '-';
                  }
                  if (!empty($value->occupation) || $value->occupation != null) {
                    $occupation = $arr_occupation[$value->occupation]['occu_name_th'];
                }
                   else {
                    $occupation = '-';
                  }
                  if (!empty($value->risk_type) || $value->risk_type != null) {
                    $risk_type = $arr_risk_type[$value->risk_type]['risk_name'];
                  } else {
                    $risk_type = '-';
                  }
                  if (!empty($value->pt_status) || $value->pt_status != null) {
                    $pt_status = $arr_pt_status[$value->pt_status];
                  } else {
                    $pt_status = '-';
                  }
                  if (!empty($value->pui_type) || $value->pui_type != null) {
                    $pui_type = $arr_pui_type[$value->pui_type];
                  } else {
                    $pui_type = '-';
                  }
                  if (!empty($value->news_st) || $value->news_st != null) {
                    $news_st = $arr_news_st[$value->news_st];
                  } else {
                    $news_st = '-';
                  }
                  if (!empty($value->disch_st) || $value->disch_st != null) {
                    $disch_st = $arr_disch_st[$value->disch_st];
                  } else {
                    $disch_st = '-';
                  }
                  if (!empty($value->walkinplace_hosp_province) || $value->walkinplace_hosp_province != null) {
                    $walkinplace_hosp_province_group = $arr_hospital[$value->walkinplace_hosp_province]['hosp_type_code'] ;
                  } else {
                    $walkinplace_hosp_province_group = '';
                  }
                  if (!empty($walkinplace_hosp_province_group) || $walkinplace_hosp_province_group != null) {
                    $walkinplace_hosp_province_group_th = $arr_hostype_th[$walkinplace_hosp_province_group] ;
                  } else {
                    $walkinplace_hosp_province_group_th= '-';
                  }
                  if (!empty($value->isolated_hosp_code) || $value->isolated_hosp_code != null) {
                    $isolated_hosp_code_group = $arr_hospital[$value->isolated_hosp_code]['hosp_type_code'] ;
                  } else {
                    $isolated_hosp_code_group = '';
                  }
                  if (!empty($isolated_hosp_code_group) || $isolated_hosp_code_group != null) {
                    $isolated_hosp_code_group_th = $arr_hostype_th[$isolated_hosp_code_group] ;
                  } else {
                    $isolated_hosp_code_group_th= '-';
                  }
                $arr = array(
                  'id' => $value->id,
                  'order_pt' => $value->order_pt,
                  'sat_id' => $value->sat_id,
                  'first_name' => $value->first_name,
                  'mid_name' => $value->mid_name,
                  'last_name' =>$value->last_name,
                  'notify_date' => $value->notify_date,
                  'walkinplace_hosp_code' => $walkinplace_hosp_code,
                  'walkinplace_hosp_province_group_th' => $walkinplace_hosp_province_group_th,
                  'airports_code' => $airports_code,
                  'walkinplace_hosp_province' => $walkinplace_hosp_province,
                  'isolated_province' => $isolated_province,
                  'isolated_hosp_code' => $isolated_hosp_code,
                  'isolated_hosp_code_group_th' => $isolated_hosp_code_group_th,
                  'travel_from_country' => $travel_from_country,
                  'travel_from_city' => $value->travel_from_city,
                  'risk_stay_outbreak_arrive_date' => $value->risk_stay_outbreak_arrive_date,
                  'risk_stay_outbreak_airline' => $value->risk_stay_outbreak_airline,
                  'risk_stay_outbreak_flight_no' => $value->risk_stay_outbreak_flight_no,
                  'total_travel_in_group' => $value->total_travel_in_group,
                  'sex' => $value->sex,
                  'age' => $value->age,
                  'nation' => $value->nation,
                  'occupation' => $occupation,
                  'occupation_oth' => $value->occupation_oth,
                  'sick_house_no' => $value->sick_house_no,
                  'sick_village_no' => $value->sick_village_no,
                  'sick_village' => $value->sick_village,
                  'sick_lane' => $value->sick_lane,
                  'sick_road' => $value->sick_road ,
                  'sick_province' => $value->sick_province,
                  'sick_district' => $value->sick_district,
                  'sick_sub_district' => $value->sick_sub_district,
                  'data3_3chk_lung' => $value->data3_3chk_lung,
                  'data3_3chk_heart' => $value->data3_3chk_heart,
                  'data3_3chk_cirrhosis' => $value->data3_3chk_cirrhosis,
                  'data3_3chk_kidney' => $value->data3_3chk_kidney,
                  'data3_3chk_diabetes' => $value->data3_3chk_diabetes,
                  'data3_3chk_blood' => $value->data3_3chk_blood,
                  'data3_3chk_immune' => $value->data3_3chk_immune,
                  'data3_3chk_anaemia' => $value->data3_3chk_anaemia,
                  'data3_3chk_cerebral' => $value->data3_3chk_cerebral,
                  'data3_3chk_pregnant' => $value->data3_3chk_pregnant,
                  'data3_3chk_fat' => $value->data3_3chk_fat,
                  'data3_3chk_cancer_name' => $value->data3_3chk_cancer_name,
                  'data3_3input_other' => $value->data3_3input_other,
                  'risk_detail' => $value->risk_detail,
                  'risk_type' => $risk_type,
                  'data3_1date_sickdate' => $value->data3_1date_sickdate,
    							'isolate_date' => $value->isolate_date,
    							'fever_history' => $value->fever_history,
    							'fever_current' => $value->fever_current,
    							'sym_cough' => $value->sym_cough,
    							'sym_snot' => $value->sym_snot,
    							'sym_sore' => $value->sym_sore,
    							'sym_dyspnea' => $value->sym_dyspnea,
    							'sym_breathe' => $value->sym_breathe,
    							'sym_stufefy' => $value->sym_stufefy,
    							'xray_result' => $value->xray_result,
    							'lab_rapid_test_result' => $value->lab_rapid_test_result,
    							'first_diag' => $value->first_diag,
    							'last_diag' => $value->last_diag,
    							'letter_division_code' => $value->letter_division_code,
    							'letter_code' => $value->letter_code,
                  'refer_bidi' => $value->refer_bidi,
                  'refer_lab' => $value->refer_lab ,
                  'op_opt' => $value->op_opt,
                  'op_dpc' => $value->op_dpc ,
                  'pt_status' => $pt_status,
    							'pui_type' => $pui_type,
    							'news_st' => $news_st,
    							'disch_st' => $disch_st,
    							'disch_st_date' => $value->disch_st_date,
    							'coordinator_tel' => $value->coordinator_tel,
    							'send_information' => $value->send_information,
    							'send_information_div' => $value->send_information_div,
    							'receive_information' => $value->receive_information,
                );
                $result->push($arr);
                }
        return $result;
            }

            public function headings(): array {
              return [
                'id',
                'order_pt',
                'sat_id',
                'ชื่อ',
                'ชื่อกลาง',
                'นามสกุล',
                'วันรับแจ้ง',
                'โรงพยาบาลที่คัดกรอง',
                'ประเภทโรงพยาบาลที่คัดกรอง',
                'สนามบินที่คัดกรอง',
                'จังหวัดโรงพยาบาลที่รักษาตัว',
                'จังหวัดของโรงพยาบาลที่ Isolated',
                'ผู้ป่วย Isolated ที่โรงพยาบาล',
                'ประเภทโรงพยาบาลที่ Isolated',
                'เดินทางมาจากประเทศ',
                'เดินทางมาจากรัฐ/มณฑณ/จังหวัด',
                'วันที่มาถึงไทย',
                'สายการบิน',
                'เที่ยวบิน',
                'จำนวนผู้ร่วมเดินทาง',
                'เพศ',
                'อายุ',
                'สัญชาติ',
                'อาชีพ',
                'อาชีพ อื่นๆ',
                'เลขที่อยู่ขณะป่วย',
                'หมู่ที่อยู่ขณะป่วย',
                'หมู่บ้านที่อยู่ขณะป่วย',
                'ซอยที่อยู่ขณะป่วย',
                'ถนนที่อยู่ขณะป่วย',
                'จังหวัดที่อยู่ขณะป่วย',
                'อำเภอที่อยู่ขณะป่วย',
                'ตำบลที่อยู่ขณะป่วย',
                'โรคประจำตัว : โรคปอดเรื้อรัง',
                'โรคประจำตัว : โรคหัวใจ',
                'โรคประจำตัว :โรคตับเรื้อรัง',
                'โรคประจำตัว : โรคไต',
                'โรคประจำตัว : โรคเบาหวาน',
                'โรคประจำตัว : ความดันโลหิตสูง',
                'โรคประจำตัว : ภูมิคุ้มกันบกพร่อง',
                'โรคประจำตัว : โลหิตจาง',
                'โรคประจำตัว : พิการทางสมอง',
                'โรคประจำตัว : ตั้งครรภ์',
                'โรคประจำตัว : โรคอ้วน',
                'โรคประจำตัว : มะเร็ง',
                'โรคประจำตัว : อื่นๆ',
                'รายละเอียดประวัติเสี่ยง',
                'ประเภทประวัติเสี่ยง',
                'วันที่เริ่มป่วย',
                'วันที่ Isolated',
                'ประวัติการมีไข้',
                'ไข้องศา',
                'ไอ',
                'น้ำมูก',
                'เจ็บคอ',
                'หายใจเหนื่อย',
                'หายใจลำบาก',
                'ซึม',
                'อาการ หายใจเหนื่อย/ลำบาก',
                'lab rapid test result',
                'แพทย์วินิจฉัยเบื้องต้น',
                'แพทย์วินิจฉัยสุดท้าย',
                'หน่วยงานที่จะส่งหนังสือ',
                'เลขหนังสือ',
                'แจ้งศูนย์บำราศ refer',
                'แจ้งศูนย์บำราศรับ lab',
                'ทีม Operation ลงเอง',
                'ทีม สคร. ลง ',
                'สถานะผู้ป่วย',
                'ประเภท PUI',
                'การแถลงข่าว',
                'สถานะการรักษา',
                'วันที่(สถานะการรักษา)',
                'ข้อมูลผู้แจ้ง: เบอร์ติดต่อ',
                'ข้อมูลผู้แจ้ง: ชื่อผู้แจ้งข้อมูล',
                'ข้อมูลผู้แจ้ง: หน่วยงาน',
                'ข้อมูลผู้แจ้ง: ชื่อผู้รับแจ้ง',
              ];
            }
}

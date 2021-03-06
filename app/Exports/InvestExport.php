<?php

namespace App\Exports;

use App\InvestList;
use App\Provinces;
use App\Occupation;
use App\GlobalCountry;
use App\Hospitals;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class InvestExport implements FromCollection, WithHeadings {

	/*protected $id;
	public function __construct($id=0)
	{
		$this->id = $id;
	}
	*/
	public function collection() {
		/* return collect([1=>[1], 2=>[2], 3=>[3]]);*/
		$prov = Provinces::all()->keyBy('province_id')->toArray();
		$occu = Occupation::all()->keyBy('id')->toArray();
		$globalCountry = GlobalCountry::all()->keyBy('country_id')->toArray();
		$hospitals = Hospitals::all()->keyBy('hospcode');
		$data = InvestList::select(
			'card_id',
			'passport',
			'hn',
			'first_name',
			'last_name',
			'sex',
			'age',
			'age_month',
			'age_days',
			'nation',
			'occupation',
			'occupation_oth',
			'work_office',
			'work_contact',
			'work_phone',
			'sick_stay_type',
			'sick_stay_type_other',
			'sick_house_no',
			'sick_village_no',
			'sick_village',
			'sick_lane',
			'sick_road',
			'sick_province',
			'sick_district',
			'sick_sub_district',
			'data3_3chk',
			'data3_3chk_lung',
			'data3_3chk_heart',
			'data3_3chk_cirrhosis',
			'data3_3chk_kidney',
			'data3_3chk_diabetes',
			'data3_3chk_blood',
			'data3_3chk_immune',
			'data3_3chk_anaemia',
			'data3_3chk_cerebral',
			'data3_3chk_pregnant',
			'data3_3chk_fat',
			'data3_3chk_cancer',
			'data3_3chk_cancer_name',
			'data3_3chk_other',
			'data3_3input_other',
			'data3_1date_sickdate',
			'sick_province_first',
			'sick_district_first',
			'sick_sub_district_first',
			'treat_first_date',
			'treat_first_province',
			'treat_first_district',
			'treat_first_sub_district',
			'treat_first_hospital',
			'treat_place_province',
			'treat_place_district',
			'treat_place_sub_district',
			'treat_place_hospital',
			'fever_history',
			'body_temperature_first',
			'oxygen_saturate',
			'sym_cough',
			'sym_sore',
			'sym_muscle',
			'sym_snot',
			'sym_sputum',
			'sym_breathe',
			'sym_headache',
			'sym_diarrhoea',
			'sym_other',
			'sym_othertext',
			'breathing_tube_chk',
			'breathing_tube_date',
			'lab_cxr1_chk',
			'lab_cxr1_date',
			'lab_cxr1_result',
			'lab_cxr1_detail',
			'lab_cxr1_file',
			'lab_cbc_date',
			'lab_cbc_hb',
			'lab_cbc_hct',
			'lab_cbc_platelet_count',
			'lab_cbc_wbc',
			'lab_cbc_neutrophil',
			'lab_cbc_lymphocyte',
			'lab_cbc_atyp_lymph',
			'lab_cbc_mono',
			'lab_cbc_other',
			'lab_rapid_test_method',
			'lab_rapid_test_date',
			'lab_rapid_test_result',
			'lab_rapid_test_pathogen_flu_a',
			'lab_rapid_test_pathogen_flu_b',
			'lab_sars_cov2_no_1_date',
			'lab_sars_cov2_no_1_specimen',
			'lab_sars_cov2_no_1_lab',
			'lab_sars_cov2_no_1_result',
			'lab_sars_cov2_no_2_date',
			'lab_sars_cov2_no_2_specimen',
			'lab_sars_cov2_no_2_lab',
			'lab_sars_cov2_no_2_result',
			'treat_patient_type',
			'treat_place_date',
			'first_diag',
			'covid19_drug_medicate',
			'covid19_drug_medicate_first_date',
			'covid19_drug_medicate_name',
			'covid19_drug_medicate_name_other',
			'patient_treat_status',
			'patient_treat_status_other',
			'risk_detail',
			'risk_type',
			'risk_type_text',
			'risk_stay_outbreak_chk',
			'risk_stay_outbreak_country',
			'risk_stay_outbreak_city',
			'risk_stay_outbreak_city_other',
			'risk_stay_outbreak_arrive_date',
			'risk_stay_outbreak_arrive_thai_date',
			'risk_stay_outbreak_airline',
			'risk_stay_outbreak_flight_no',
			'risk_stay_outbreak_seat_no',
			'risk_stay_outbreak_province',
			'risk_stay_outbreak_district',
			'risk_stay_outbreak_sub_district',
			'risk_treat_or_visit_patient',
			'risk_care_flu_patient',
			'risk_contact_covid_19',
			'risk_contact_covid_19_patient_name',
			'risk_contact_covid_19_sat_id',
			'risk_contact_covid_19_touch',
			'risk_contact_covid_19_duration',
			'risk_contact_tourist',
			'risk_travel_to_arena',
			'risk_travel_arena_name',
			'be_patient_cluster',
			'be_patient_critical_unknown_cause',
			'be_health_personel',
			'risk_other',
			'entry_user',
			'pt_status'
		)
		//->where('pt_status', '=', 2)
		//->where('id', '=', $this->id)
		->whereNull('deleted_at')
		->limit(10000)
		->get()
		->toArray();

		$result = collect();
		foreach($data as $key => $val) {
			if (!empty($val['occupation']) || $val['occupation'] != null) {
				if ($val['occupation'] == 99) {
					$occ = $val['occupation_oth'];
				} else {
					$occ = $occu[$val['occupation']]['occu_name_th'];
				}
			} else {
				$occ = '-';
			}
			if (!empty($val['nation']) || $val['nation'] != null) {
				$nation = $globalCountry[$val['nation']]['country_name'];
			} else {
				$nation = '-';
			}
			/*
			if (!empty($val['walkinplace_hosp_code']) || $val['walkinplace_hosp_code'] != null) {
				$walk_hosp = $hospitals[$val['walkinplace_hosp_code']]['hosp_name'];
			} else {
				$walk_hosp= '-';
			}
			if (!empty($val['walkinplace_hosp_province']) || $val['walkinplace_hosp_province'] != null) {
				$walk_prov = $prov[$val['walkinplace_hosp_province']]['province_name'];
			} else {
				$walk_prov= '-';
			}
			if (!empty($val['isolated_hosp_code']) || $val['isolated_hosp_code'] != null) {
				$iso_hosp = $hospitals[$val['isolated_hosp_code']]['hosp_name'];
			} else {
				$iso_hosp= '-';
			}
			if (!empty($val['isolated_province']) || $val['isolated_province'] != null) {
				$iso_prov = $prov[$val['isolated_province']]['province_name'];
			} else {
				$iso_prov = '-';
			}
			*/
			$arr = array(
				'card_id' => $val['card_id'],
				'passport' => $val['passport'],
				'hn' => $val['hn'],
				'first_name' => $val['first_name'],
				'last_name' => $val['last_name'],
				'sex' => $val['sex'],
				'age' => $val['age'],
				'age_month' => $val['age_month'],
				'age_days' => $val['age_days'],
				'nation' => $nation,
				'occupation' => $occ,
				'occupation_oth' => $val['occupation_oth'],
				'work_office' => $val['work_office'],
				'work_contact' => $val['work_contact'],
				'work_phone' => $val['work_phone'],
				'sick_stay_type' => $val['sick_stay_type'],
				'sick_stay_type_other' => $val['sick_stay_type_other'],
				'sick_house_no' => $val['sick_house_no'],
				'sick_village_no' => $val['sick_village_no'],
				'sick_village' => $val['sick_village'],
				'sick_lane' => $val['sick_lane'],
				'sick_road' => $val['sick_road'],
				'sick_province' => $val['sick_province'],
				'sick_district' => $val['sick_district'],
				'sick_sub_district' => $val['sick_sub_district'],
				'data3_3chk' => $val['data3_3chk'],
				'data3_3chk_lung' => $val['data3_3chk_lung'],
				'data3_3chk_heart' => $val['data3_3chk_heart'],
				'data3_3chk_cirrhosis' => $val['data3_3chk_cirrhosis'],
				'data3_3chk_kidney' => $val['data3_3chk_kidney'],
				'data3_3chk_diabetes' => $val['data3_3chk_diabetes'],
				'data3_3chk_blood' => $val['data3_3chk_blood'],
				'data3_3chk_immune' => $val['data3_3chk_immune'],
				'data3_3chk_anaemia' => $val['data3_3chk_anaemia'],
				'data3_3chk_cerebral' => $val['data3_3chk_cerebral'],
				'data3_3chk_pregnant' => $val['data3_3chk_pregnant'],
				'data3_3chk_fat' => $val['data3_3chk_fat'],
				'data3_3chk_cancer' => $val['data3_3chk_cancer'],
				'data3_3chk_cancer_name' => $val['data3_3chk_cancer_name'],
				'data3_3chk_other' => $val['data3_3chk_other'],
				'data3_3input_other' => $val['data3_3input_other'],
				'data3_1date_sickdate' => $val['data3_1date_sickdate'],
				'sick_province_first' => $val['sick_province_first'],
				'sick_district_first' => $val['sick_district_first'],
				'sick_sub_district_first' => $val['sick_sub_district_first'],
				'treat_first_date' => $val['treat_first_date'],
				'treat_first_province' => $val['treat_first_province'],
				'treat_first_district' => $val['treat_first_district'],
				'treat_first_sub_district' => $val['treat_first_sub_district'],
				'treat_first_hospital' => $val['treat_first_hospital'],
				'treat_place_province' => $val['treat_place_province'],
				'treat_place_district' => $val['treat_place_district'],
				'treat_place_sub_district' => $val['treat_place_sub_district'],
				'treat_place_hospital' => $val['treat_place_hospital'],
				'fever_history' => $val['fever_history'],
				'body_temperature_first' => $val['body_temperature_first'],
				'oxygen_saturate' => $val['oxygen_saturate'],
				'sym_cough' => $val['sym_cough'],
				'sym_sore' => $val['sym_sore'],
				'sym_muscle' => $val['sym_muscle'],
				'sym_snot' => $val['sym_snot'],
				'sym_sputum' => $val['sym_sputum'],
				'sym_breathe' => $val['sym_breathe'],
				'sym_headache' => $val['sym_headache'],
				'sym_diarrhoea' => $val['sym_diarrhoea'],
				'sym_other' => $val['sym_other'],
				'sym_othertext' => $val['sym_othertext'],
				'breathing_tube_chk' => $val['breathing_tube_chk'],
				'breathing_tube_date' => $val['breathing_tube_date'],
				'lab_cxr1_chk' => $val['lab_cxr1_chk'],
				'lab_cxr1_date' => $val['lab_cxr1_date'],
				'lab_cxr1_result' => $val['lab_cxr1_result'],
				'lab_cxr1_detail' => $val['lab_cxr1_detail'],
				'lab_cxr1_file' => $val['lab_cxr1_file'],
				'lab_cbc_date' => $val['lab_cbc_date'],
				'lab_cbc_hb' => $val['lab_cbc_hb'],
				'lab_cbc_hct' => $val['lab_cbc_hct'],
				'lab_cbc_platelet_count' => $val['lab_cbc_platelet_count'],
				'lab_cbc_wbc' => $val['lab_cbc_wbc'],
				'lab_cbc_neutrophil' => $val['lab_cbc_neutrophil'],
				'lab_cbc_lymphocyte' => $val['lab_cbc_lymphocyte'],
				'lab_cbc_atyp_lymph' => $val['lab_cbc_atyp_lymph'],
				'lab_cbc_mono' => $val['lab_cbc_mono'],
				'lab_cbc_other' => $val['lab_cbc_other'],
				'lab_rapid_test_method' => $val['lab_rapid_test_method'],
				'lab_rapid_test_date' => $val['lab_rapid_test_date'],
				'lab_rapid_test_result' => $val['lab_rapid_test_result'],
				'lab_rapid_test_pathogen_flu_a' => $val['lab_rapid_test_pathogen_flu_a'],
				'lab_rapid_test_pathogen_flu_b' => $val['lab_rapid_test_pathogen_flu_b'],
				'lab_sars_cov2_no_1_date' => $val['lab_sars_cov2_no_1_date'],
				'lab_sars_cov2_no_1_specimen' => $val['lab_sars_cov2_no_1_specimen'],
				'lab_sars_cov2_no_1_lab' => $val['lab_sars_cov2_no_1_lab'],
				'lab_sars_cov2_no_1_result' => $val['lab_sars_cov2_no_1_result'],
				'lab_sars_cov2_no_2_date' => $val['lab_sars_cov2_no_2_date'],
				'lab_sars_cov2_no_2_specimen' => $val['lab_sars_cov2_no_2_specimen'],
				'lab_sars_cov2_no_2_lab' => $val['lab_sars_cov2_no_2_lab'],
				'lab_sars_cov2_no_2_result' => $val['lab_sars_cov2_no_2_result'],
				'treat_patient_type' => $val['treat_patient_type'],
				'treat_place_date' => $val['treat_place_date'],
				'first_diag' => $val['first_diag'],
				'covid19_drug_medicate' => $val['covid19_drug_medicate'],
				'covid19_drug_medicate_first_date' => $val['covid19_drug_medicate_first_date'],
				'covid19_drug_medicate_name' => $val['covid19_drug_medicate_name'],
				'covid19_drug_medicate_name_other' => $val['covid19_drug_medicate_name_other'],
				'patient_treat_status' => $val['patient_treat_status'],
				'patient_treat_status_other' => $val['patient_treat_status_other'],
				'risk_detail' => $val['risk_detail'],
				'risk_type' => $val['risk_type'],
				'risk_type_text' => $val['risk_type_text'],
				'risk_stay_outbreak_chk' => $val['risk_stay_outbreak_chk'],
				'risk_stay_outbreak_country' => $val['risk_stay_outbreak_country'],
				'risk_stay_outbreak_city' => $val['risk_stay_outbreak_city'],
				'risk_stay_outbreak_city_other' => $val['risk_stay_outbreak_city_other'],
				'risk_stay_outbreak_arrive_date' => $val['risk_stay_outbreak_arrive_date'],
				'risk_stay_outbreak_arrive_thai_date' => $val['risk_stay_outbreak_arrive_thai_date'],
				'risk_stay_outbreak_airline' => $val['risk_stay_outbreak_airline'],
				'risk_stay_outbreak_flight_no' => $val['risk_stay_outbreak_flight_no'],
				'risk_stay_outbreak_seat_no' => $val['risk_stay_outbreak_seat_no'],
				'risk_stay_outbreak_province' => $val['risk_stay_outbreak_province'],
				'risk_stay_outbreak_district' => $val['risk_stay_outbreak_district'],
				'risk_stay_outbreak_sub_district' => $val['risk_stay_outbreak_sub_district'],
				'risk_treat_or_visit_patient' => $val['risk_treat_or_visit_patient'],
				'risk_care_flu_patient' => $val['risk_care_flu_patient'],
				'risk_contact_covid_19' => $val['risk_contact_covid_19'],
				'risk_contact_covid_19_patient_name' => $val['risk_contact_covid_19_patient_name'],
				'risk_contact_covid_19_sat_id' => $val['risk_contact_covid_19_sat_id'],
				'risk_contact_covid_19_touch' => $val['risk_contact_covid_19_touch'],
				'risk_contact_covid_19_duration' => $val['risk_contact_covid_19_duration'],
				'risk_contact_tourist' => $val['risk_contact_tourist'],
				'risk_travel_to_arena' => $val['risk_travel_to_arena'],
				'risk_travel_arena_name' => $val['risk_travel_arena_name'],
				'be_patient_cluster' => $val['be_patient_cluster'],
				'be_patient_critical_unknown_cause' => $val['be_patient_critical_unknown_cause'],
				'be_health_personel' => $val['be_health_personel'],
				'risk_other' => $val['risk_other'],
				'entry_user' => $val['entry_user'],
				'pt_status' => 'Confirmed'
			);
			$result->push($arr);
		}
		return $result;
	}

	public function headings(): array {
		return [
			'บัตร ปชช.',
			'พาสปอร์ต',
			'HN',
			'ชื่อ',
			'นามสกุล',
			'เพศ',
			'อายุปี',
			'อายุเดือน',
			'อายุวัน',
			'สัญชาติ',
			'อาชีพ',
			'อาชีพอื่นๆ',
			'สถานที่ทำงาน/สถานศึกษา',
			'ลักษณะงานที่เสี่ยงติดโรค',
			'โทรศัพท์ที่ติดต่อได้',
			'ที่อยู่ขณะป่วย (ปัจจุบัน)',
			'ที่อยู่ขณะป่วย (ปัจจุบัน) อื่นๆ',
			'บ้านเลขที่',
			'หมู่ที่',
			'หมู่บ้าน/ชุมชน',
			'ซอย',
			'ถนน',
			'จังหวัด',
			'อำเภอ',
			'ตำบล',
			'โรคประจำตัว',
			'โรคปอดเรื้อรัง',
			'โรคหัวใจ',
			'โรคตับเรื้อรัง',
			'โรคไต',
			'เบาหวาน',
			'ความดันโลหิตสูง',
			'ภูมิคุ้มกันบกพร่อง',
			'โลหิตจาง',
			'พิการทางสมอง',
			'ตั้งครรภ์',
			'อ้วน',
			'มะเร็ง',
			'มะเร็ง (ระบุชื่อ)',
			'โรคประจำตัวอื่นๆ',
			'โรคประจำตัวอื่นๆ ระบุ',
			'วันที่เริ่มป่วย',
			'จังหวัดที่เริ่มป่วย',
			'อำเภอที่เริ่มป่วย',
			'ตำบลที่เริ่มป่วย',
			'วันที่เข้ารักษาครั้งแรก',
			'จังหวัดที่เข้ารักษาครั้งแรก',
			'อำเภอที่เข้ารักษาครั้งแรก',
			'ตำบลที่เข้ารักษาครั้งแรก',
			'สถานพยาบาลที่รักษาครั้งแรก',
			'จังหวัดที่รักษาปัจจุบัน',
			'อำเภอที่รักษาปัจจุบัน',
			'ตำบลที่รักษาปัจจุบัน',
			'สถานที่รักษาปัจจุบัน',
			'ประวัติมีไข้',
			'อุณหภูมิร่างกายแรกรับ',
			'ความเข้มข้นของ Oxygen',
			'ไอ',
			'เจ็บคอ',
			'ปวดกล้ามเนื้อ',
			'มีน้ำมูก',
			'มีเสมหะ',
			'หายใจลำบาก',
			'ปวดศีรษะ',
			'ถ่ายเหลว',
			'อื่นๆ',
			'อาการอื่นๆ ระบุ',
			'ใส่ท่อช่วยหายใจ',
			'วันที่ใส่ท่อช่วยหายใจ',
			'เอ็กซเรย์ปอด (ครั้งแรก)',
			'เอ็กซเรย์ปอด วันที่',
			'ผลเอ๊กเรย์',
			'ผลเอ๊กเรย์ อื่นๆ',
			'ภาพถ่ายผลเอ๊กเรย์',
			'CBC (ครั้งแรก) วันที่',
			'Hb',
			'Hct',
			'Platelet count',
			'WBC',
			'N',
			'L',
			'Atyp lymph',
			'Mono',
			'CBC อื่นๆ ระบุ',
			'Influenza test',
			'Test วันที่',
			'ผลการตรวจ',
			'Influenza A',
			'Influenza B',
			'PCR COVID-19#1 วันที่',
			'PCR COVID-19#1 ตัวอย่าง',
			'PCR COVID-19#1 สถานที่ตรวจ',
			'PCR COVID-19#1 ผลตรวจ',
			'PCR COVID-19#2 วันที่',
			'PCR COVID-19#2 ตัวอย่าง',
			'PCR COVID-19#2 สถานที่ตรวจ',
			'PCR COVID-19#2 ผลตรวจ',
			'ประเภทผู้ป่วย',
			'Admited วันที่',
			'การวินิจฉัยเบื้องต้น',
			'การให้ยารักษาโรคติดเชื้อไวรัสโคโรนา 2019',
			'วันที่ให้ยาโดสแรก',
			'ชนิดยารักษาโรคติดเชื้อไวรัสโคโรนา 2019',
			'ยาอื่นๆ ระบุ',
			'สถานะผู้ป่วย',
			'สถานะอื่นๆ ระบุ',
			'รายละเอียดเหตุการณ์ ',
			'ประเภทประวัติเสี่ยง',
			'ประเภทประวัติเสี่ยงอื่นๆ',
			'ช่วง 14 วันก่อนป่วย ท่านอาศัยอยู่ หรือ มีการเดินทางมาจากพื้นที่ที่มีการระบาด',
			'ประเทศ',
			'เมือง (กรณี ตปท.)',
			'เมืองอื่นๆ (กรณี ตปท.)',
			'วันที่เดินทางไปถึง',
			'วันที่เดินทางมาถึงไทย',
			'สายการบิน',
			'เที่ยวบินที่',
			'เลขที่นั่ง',
			'จังหวัด (กรณี ประเทศไทย)',
			'อำเภอ (กรณี ประเทศไทย)',
			'ตำบล (กรณี ประเทศไทย)',
			'ช่วง 14 วันก่อนป่วย ท่านได้เข้ารับการรักษาหรือเยี่ยมผู้ป่วยในโรงพยาบาลของพื้นที่ที่มีการระบาด',
			'ช่วง 14 วันก่อนป่วย ท่านใด้ดูแลหรือสัมผัสใกล้ชิดกับผู้ป่วยอาการคล้ายไข้หวัดใหญ่หรือปอดอักเสบ',
			'ช่วง 14 วันก่อนป่วย ท่านมีประวัติสัมผัสกับผู้ป่วยยืนยันโรคติดเชื้อไวรัสโคโรนา 2019',
			'ชื่อ-นามสกุล',
			'รหัส SAT ID',
			'ลักษณะการสัมผัส',
			'ช่วงระยะเวลาที่มีการสัมผัส',
			'ช่วง 14 วันก่อนป่วย ท่านประกอบอาชีพที่สัมผัสใกล้ชิดกับนักท่องเที่ยวต่างชาติ',
			'ช่วง 14 วันก่อนป่วย ท่านมีประวัติเดินทางไปในสถานที่ที่มีคนหนาแน่น เช่น ผับ สนามมวย หรือไม่',
			'ระบุชื่อสถานที่',
			'เป็นผู้ป่วยอาการทางเดินหายใจหรือปอดอักเสบเป็นกลุ่มก้อน',
			'เป็นผู้ป่วยปอดอักเสบรุนแรงหรือเสียชีวิตที่หาสาเหตุไม่ได้',
			'เป็นบุคลากรทางการแพทย์และสาธารณสุขหรือเจ้าหน้าที่ห้องปฏิบัติการ',
			'อื่นๆ ระบุ',
			'ผู้รายงาน',
			'สถานะผู้ป่วย'
		];
	}

	private function setThaiHeading() {
		$heading_coll = collect([
			'card_id' => 'บัตร ปชช.',
			'passport' => 'พาสปอร์ต',
			'hn' => 'HN',
			'first_name' => 'ชื่อ',
			'last_name' => 'นามสกุล',
			'sex' => 'เพศ',
			'age' => 'อายุปี',
			'age_month'=> 'อายุเดือน',
			'age_days' => 'อายุวัน',
			'nation' => 'สัญชาติ',
			'occupation' => 'อาชีพ',
			'occupation_oth' => 'อาชีพอื่นๆ',
			'work_office' => 'สถานที่ทำงาน/สถานศึกษา',
			'work_contact' => 'ลักษณะงานที่เสี่ยงติดโรค',
			'work_phone' => 'โทรศัพท์ที่ติดต่อได้',
			'sick_stay_type' => 'ที่อยู่ขณะป่วย (ปัจจุบัน)',
			'sick_stay_type_other' => 'ที่อยู่ขณะป่วย (ปัจจุบัน) อื่นๆ',
			'sick_house_no' => 'บ้านเลขที่',
			'sick_village_no' => 'หมู่ที่',
			'sick_village' => 'หมู่บ้าน/ชุมชน',
			'sick_lane' => 'ซอย',
			'sick_road' => 'ถนน',
			'sick_province' => 'จังหวัด',
			'sick_district' => 'อำเภอ',
			'sick_sub_district' => 'ตำบล',
			'data3_3chk' => 'โรคประจำตัว',
			'data3_3chk_lung' => 'โรคปอดเรื้อรัง',
			'data3_3chk_heart' => 'โรคหัวใจ',
			'data3_3chk_cirrhosis' => 'โรคตับเรื้อรัง',
			'data3_3chk_kidney' => 'โรคไต',
			'data3_3chk_diabetes' => 'เบาหวาน',
			'data3_3chk_blood' => 'ความดันโลหิตสูง',
			'data3_3chk_immune' => 'ภูมิคุ้มกันบกพร่อง',
			'data3_3chk_anaemia' => 'โลหิตจาง',
			'data3_3chk_cerebral' => 'พิการทางสมอง',
			'data3_3chk_pregnant' => 'ตั้งครรภ์',
			'data3_3chk_fat' => 'อ้วน',
			'data3_3chk_cancer' => 'มะเร็ง',
			'data3_3chk_cancer_name' => 'มะเร็ง (ระบุชื่อ)',
			'data3_3chk_other' => 'โรคประจำตัวอื่นๆ',
			'data3_3input_other' => 'โรคประจำตัวอื่นๆ ระบุ',
			'data3_1date_sickdate' => 'วันที่เริ่มป่วย',
			'sick_province_first' => 'จังหวัดที่เริ่มป่วย',
			'sick_district_first' => 'อำเภอที่เริ่มป่วย',
			'sick_sub_district_first' => 'ตำบลที่เริ่มป่วย',
			'treat_first_date' => 'วันที่เข้ารักษาครั้งแรก',
			'treat_first_province' => 'จังหวัดที่เข้ารักษาครั้งแรก',
			'treat_first_district' => 'อำเภอที่เข้ารักษาครั้งแรก',
			'treat_first_sub_district' => 'ตำบลที่เข้ารักษาครั้งแรก',
			'treat_first_hospital' => 'สถานพยาบาลที่รักษาครั้งแรก',
			'treat_place_province' => 'จังหวัดที่รักษาปัจจุบัน',
			'treat_place_district'=> 'อำเภอที่รักษาปัจจุบัน',
			'treat_place_sub_district' => 'ตำบลที่รักษาปัจจุบัน',
			'treat_place_hospital' => 'สถานที่รักษาปัจจุบัน',
			'fever_history' => 'ประวัติมีไข้',
			'body_temperature_first' => 'อุณหภูมิร่างกายแรกรับ',
			'oxygen_saturate' => 'ความเข้มข้นของ Oxygen',
			'sym_cough' => 'ไอ',
			'sym_sore' => 'เจ็บคอ',
			'sym_muscle' => 'ปวดกล้ามเนื้อ',
			'sym_snot' => 'มีน้ำมูก',
			'sym_sputum' => 'มีเสมหะ',
			'sym_breathe' => 'หายใจลำบาก',
			'sym_headache' => 'ปวดศีรษะ',
			'sym_diarrhoea' => 'ถ่ายเหลว',
			'sym_other' => 'อื่นๆ',
			'sym_othertext' => 'อาการอื่นๆ ระบุ',
			'breathing_tube_chk' => 'ใส่ท่อช่วยหายใจ',
			'breathing_tube_date' => 'วันที่ใส่ท่อช่วยหายใจ',
			'lab_cxr1_chk' => 'เอ็กซเรย์ปอด (ครั้งแรก)',
			'lab_cxr1_date' => 'เอ็กซเรย์ปอด วันที่',
			'lab_cxr1_result' => 'ผลเอ๊กเรย์',
			'lab_cxr1_detail' => 'ผลเอ๊กเรย์ อื่นๆ',
			'lab_cxr1_file' => 'ภาพถ่ายผลเอ๊กเรย์',
			'lab_cbc_date' => 'CBC (ครั้งแรก) วันที่',
			'lab_cbc_hb' => 'Hb',
			'lab_cbc_hct' => 'Hct',
			'lab_cbc_platelet_count' => 'Platelet count',
			'lab_cbc_wbc' => 'WBC',
			'lab_cbc_neutrophil' => 'N',
			'lab_cbc_lymphocyte' => 'L',
			'lab_cbc_atyp_lymph' => 'Atyp lymph',
			'lab_cbc_mono' => 'Mono',
			'lab_cbc_other' => 'CBC อื่นๆ ระบุ',
			'lab_rapid_test_method' => 'Influenza test',
			'lab_rapid_test_date' => 'Test วันที่',
			'lab_rapid_test_result' => 'ผลการตรวจ',
			'lab_rapid_test_pathogen_flu_a' => 'Influenza A',
			'lab_rapid_test_pathogen_flu_b' => 'Influenza B',
			'lab_sars_cov2_no_1_date' => 'PCR COVID-19#1 วันที่',
			'lab_sars_cov2_no_1_specimen' => 'PCR COVID-19#1 ตัวอย่าง',
			'lab_sars_cov2_no_1_lab' => 'PCR COVID-19#1 สถานที่ตรวจ',
			'lab_sars_cov2_no_1_result' => 'PCR COVID-19#1 ผลตรวจ',
			'lab_sars_cov2_no_2_date' => 'PCR COVID-19#2 วันที่',
			'lab_sars_cov2_no_2_specimen' => 'PCR COVID-19#2 ตัวอย่าง',
			'lab_sars_cov2_no_2_lab' => 'PCR COVID-19#2 สถานที่ตรวจ',
			'lab_sars_cov2_no_2_result' => 'PCR COVID-19#2 ผลตรวจ',
			'treat_patient_type' => 'ประเภทผู้ป่วย',
			'treat_place_date' => 'Admited วันที่',
			'first_diag' => 'การวินิจฉัยเบื้องต้น',
			'covid19_drug_medicate' => 'การให้ยารักษาโรคติดเชื้อไวรัสโคโรนา 2019',
			'covid19_drug_medicate_first_date' => 'วันที่ให้ยาโดสแรก',
			'covid19_drug_medicate_name' => 'ชนิดยารักษาโรคติดเชื้อไวรัสโคโรนา 2019',
			'covid19_drug_medicate_name_other' => 'ยาอื่นๆ ระบุ',
			'patient_treat_status' => 'สถานะผู้ป่วย',
			'patient_treat_status_other' => 'สถานะอื่นๆ ระบุ',
			'risk_detail' => 'รายละเอียดเหตุการณ์ ',
			'risk_type' => 'ประเภทประวัติเสี่ยง',
			'risk_type_text' => 'ประเภทประวัติเสี่ยงอื่นๆ',
			'risk_stay_outbreak_chk' => 'ช่วง 14 วันก่อนป่วย ท่านอาศัยอยู่ หรือ มีการเดินทางมาจากพื้นที่ที่มีการระบาด',
			'risk_stay_outbreak_country' => 'ประเทศ',
			'risk_stay_outbreak_city' => 'เมือง (กรณี ตปท.)',
			'risk_stay_outbreak_city_other' => 'เมือง (กรณี ตปท.)',
			'risk_stay_outbreak_arrive_date' => 'วันที่เดินทางไปถึง',
			'risk_stay_outbreak_arrive_thai_date' => 'วันที่เดินทางมาถึงไทย',
			'risk_stay_outbreak_airline' => 'สายการบิน',
			'risk_stay_outbreak_flight_no' => 'เที่ยวบินที่',
			'risk_stay_outbreak_seat_no' => 'เลขที่นั่ง',
			'risk_stay_outbreak_province' => 'จังหวัด (กรณี ประเทศไทย)',
			'risk_stay_outbreak_district' => 'อำเภอ (กรณี ประเทศไทย)',
			'risk_stay_outbreak_sub_district' => 'ตำบล (กรณี ประเทศไทย)',
			'risk_treat_or_visit_patient' => 'ช่วง 14 วันก่อนป่วย ท่านได้เข้ารับการรักษาหรือเยี่ยมผู้ป่วยในโรงพยาบาลของพื้นที่ที่มีการระบาด',
			'risk_care_flu_patient' => 'ช่วง 14 วันก่อนป่วย ท่านใด้ดูแลหรือสัมผัสใกล้ชิดกับผู้ป่วยอาการคล้ายไข้หวัดใหญ่หรือปอดอักเสบ',
			'risk_contact_covid_19' => 'ช่วง 14 วันก่อนป่วย ท่านมีประวัติสัมผัสกับผู้ป่วยยืนยันโรคติดเชื้อไวรัสโคโรนา 2019',
			'risk_contact_covid_19_patient_name' => 'ชื่อ-นามสกุล',
			'risk_contact_covid_19_sat_id' => 'รหัส SAT ID',
			'risk_contact_covid_19_touch' => 'ลักษณะการสัมผัส',
			'risk_contact_covid_19_duration' => 'ช่วงระยะเวลาที่มีการสัมผัส',
			'risk_contact_tourist' => 'ช่วง 14 วันก่อนป่วย ท่านประกอบอาชีพที่สัมผัสใกล้ชิดกับนักท่องเที่ยวต่างชาติ',
			'risk_travel_to_arena' => 'ช่วง 14 วันก่อนป่วย ท่านมีประวัติเดินทางไปในสถานที่ที่มีคนหนาแน่น เช่น ผับ สนามมวย หรือไม่',
			'risk_travel_arena_name' => 'ระบุชื่อสถานที่',
			'be_patient_cluster' => 'เป็นผู้ป่วยอาการทางเดินหายใจหรือปอดอักเสบเป็นกลุ่มก้อน',
			'be_patient_critical_unknown_cause' => 'เป็นผู้ป่วยปอดอักเสบรุนแรงหรือเสียชีวิตที่หาสาเหตุไม่ได้',
			'be_health_personel' => 'เป็นบุคลากรทางการแพทย์และสาธารณสุขหรือเจ้าหน้าที่ห้องปฏิบัติการ',
			'risk_other' => 'อื่นๆ ระบุ',
			'entry_user' => 'ผู้รายงาน',
			'pt_status' => 'สถานะผู้ป่วย'
		]);
		return $heading_coll;
	}

}

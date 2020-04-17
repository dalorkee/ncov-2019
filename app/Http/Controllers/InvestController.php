<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Storage;
use App\Invest;
use App\TitleName;
use App\Provinces;
use App\District;
use App\SubDistrict;
use App\Hospitals;
use App\Occupation;
use App\GlobalCity;
use App\GlobalCountry;
use App\LabStation;
use App\Specimen;
use App\PatientActivity;
use App\RiskType;
use DB;
use Session;
use App\User;
use App\Exports\InvestExportFromQuery;
use App\Exports\LogExport;
use Log;
use Rap2hpoutre\FastExcel\FastExcel;
use Carbon\Carbon;

class InvestController extends MasterController
{
	public function __construct() {
		$this->middleware('auth');
		$this->middleware(['role:root|ddc|dpc|pho|hos']);
	}

	public function exportFromQuery(Request $request) {
		try {
			(new InvestExportFromQuery)->store('export-file.csv', 'excel');
			return [
				'success' => true,
				'path' => 'http://'.$request->server('HTTP_HOST').'/exports/excel/export-file.csv'
			];
		} catch(\Exception $e) {
			Log::error($e->getMessage());
		}
	}

	protected function setDateRange($date_range) {
		$exp = explode("/", $date_range);
		$result = $exp[2].'-'.$exp[0].'-'.$exp[1];
		return $result;
	}

	public function exportPage() {
		$fileName = self::setExportFileName();
		$pt_status = parent::selectStatus('pt_status');
		return view('export.invest',
			[
				'pt_status' => $pt_status
			]
		);
	}

	protected function setExportFileName($extension='csv') {
		$uid = auth()->user()->id;
		$current_timestamp = Carbon::now()->timestamp;
		$fileName = 'c'.$uid.'-'.$current_timestamp.'.'.$extension;
		return $fileName;
	}

	public function downloadFile($fileName=null) {
		try {
		$exists = Storage::disk('export')->exists($fileName);
			if ($exists) {
				$log = DB::table('log_export')->select('export_amount', 'expire_date')->where('file_name', '=', $fileName)->get()->toArray();
				$new_amount = ((int)$log[0]->export_amount+1);
				$now = date('Y-m-d H:i:s');
				$affected = DB::table('log_export')
					->where('file_name', $fileName)
					->update(['export_amount' => $new_amount, 'last_export_date' => $now]);
				$filePath = public_path('exports/'.$fileName);
				return response()->download($filePath);
			} else {
				return '<div>File not found.</div>';
			}
		} catch(\Exception $e) {
			Log::error(sprintf("%s - line %d - ", __FILE__, __LINE__).$e->getMessage());
		}
	}

	public function exportFastExcel(Request $request) {
		try {
			$fileName = self::setExportFileName();
			if ($request->pt_status == 'all') {
				$pts = parent::selectStatus('pt_status');
				$result_status = array_keys($pts);
			} else {
				$result_status = array($request->pt_status);
			}
			$exp_date = explode("-", $request->date_range);
			$start_date = $this->setDateRange(trim($exp_date[0]));
			$end_date = $this->setDateRange(trim($exp_date[1]));

			/* get default data */
			$provinces = Provinces::all()->sortBy('province_name')->keyBy('province_id')->toArray();
			$globalCountry = GlobalCountry::all()->keyBy('country_id')->toArray();
			$occupation = Occupation::all()->keyBy('id')->toArray();

			/* create file */
			$result = (new FastExcel($this->dataGenerator($result_status, $start_date, $end_date)))->export('exports/'.$fileName, function($x) use ($globalCountry, $provinces, $occupation) {
				$nation = (!empty($x->nation)) ? $globalCountry[$x->nation]['country_name_th'] : NULL;
				/* occupation */
				if (!empty($x->occupation) || $x->occupation > 0 || !is_null($x->occupation)) {
					$occupation_name = $occupation[$x->occupation]['occu_name_th'];
				} else {
					$occupation_name = NULL;
				}
				/* sick addr */
				if (!empty($x->sick_province) || $x->sick_province != 0) {
					$sick_prov_name = $provinces[$x->sick_province]['province_name'];
				} else {
					$sick_prov_name = NULL;
				}
				if (!empty($x->sick_district) || $x->sick_district != 0) {
					$sick_dist = self::getDistirctNameTh($x->sick_district);
					$sick_dist_name = $sick_dist[0]['district_name'];
				} else {
					$sick_dist_name = NULL;
				}
				if (!empty($x->sick_sub_district) || $x->sick_sub_district != 0) {
					$sick_sub_dist = self::getSubDistirctNameTh($x->sick_sub_district);
					$sick_sub_dist_name = $sick_sub_dist[0]['sub_district_name'];
				} else {
					$sick_sub_dist_name = NULL;
				}

				/* sick first addr */
				if (!empty($x->sick_province_first) || $x->sick_province_first != 0) {
					$sick_prov_first = $provinces[$x->sick_province_first]['province_name'];
				} else {
					$sick_prov_first = NULL;
				}
				if (!empty($x->sick_district_first) || $x->sick_district_first != 0) {
					$sick_dist_first = self::getDistirctNameTh($x->sick_district_first);
					$sick_dist_first_name = $sick_dist_first[0]['district_name'];
				} else {
					$sick_dist_first_name = NULL;
				}
				if (!empty($x->sick_sub_district_first) || $x->sick_sub_district_first != 0) {
					$sick_sub_dist_first = self::getSubDistirctNameTh($x->sick_sub_district_first);
					$sick_sub_dist_name_first = $sick_sub_dist_first[0]['sub_district_name'];
				} else {
					$sick_sub_dist_name_first = NULL;
				}

				/* treat first addr */
				if (!empty($x->treat_first_province) || $x->treat_first_province != 0) {
					$treat_first_prov = $provinces[$x->treat_first_province]['province_name'];
				} else {
					$treat_first_prov = NULL;
				}
				if (!empty($x->treat_first_district) || $x->treat_first_district) {
					$treat_first_dist = self::getDistirctNameTh($x->treat_first_district);
					$treat_first_dist_name = $treat_first_dist[0]['district_name'];
				} else {
					$treat_first_dist_name = NULL;
				}
				if (!empty($x->treat_first_sub_district) || $x->treat_first_sub_district != 0) {
					$treat_first_sub_dist = self::getSubDistirctNameTh($x->treat_first_sub_district);
					$treat_first_sub_dist_name = $treat_first_sub_dist[0]['sub_district_name'];
				} else {
					$treat_first_sub_dist_name = NULL;
				}
				if (!empty($x->treat_first_hospital) || $x->treat_first_hospital != 0) {
					$treat_first_hosp = self::getHospitalNameTh($x->treat_first_hospital);
					$treat_first_hosp_name = $treat_first_hosp[0]['hosp_name'];
				} else {
					$treat_first_hosp_name = NULL;
				}

				/* treat place */
				if (!empty($x->treat_place_province) || $x->treat_place_province != 0) {
					$treat_place_prov = $provinces[$x->treat_place_province]['province_name'];
				} else {
					$treat_place_prov = NULL;
				}
				if (!empty($x->treat_place_district) || $x->treat_place_district != 0) {
					$treat_place_dist = self::getDistirctNameTh($x->treat_place_district);
					$treat_place_dist_name = $treat_place_dist[0]['district_name'];
				} else {
					$treat_place_dist_name = NULL;
				}
				if (!empty($x->treat_place_sub_district) || $x->treat_place_sub_district != 0) {
					$treat_place_sub_dist = self::getSubDistirctNameTh($x->treat_place_sub_district);
					$treat_place_sub_dist_name = $treat_place_sub_dist[0]['sub_district_name'];
				} else {
					$treat_place_sub_dist_name = NULL;
				}
				if (!empty($x->treat_place_hospital) || $x->treat_place_hospital != 0) {
					$treat_place_hosp = self::getHospitalNameTh($x->treat_place_hospital);
					$treat_place_hosp_name = $treat_place_hosp[0]['hosp_name'];
				} else {
					$treat_place_hosp_name = NULL;
				}

				/* lab x-ray */
				switch ($x->lab_cxr1_result) {
					case 'normal':
						$lab_cxr1_result_name = 'ปกติ';
						break;
					case 'unusual':
						$lab_cxr1_result_name = 'ผิดปกติ';
						break;
					default:
						$lab_cxr1_result_name = NULL;
						break;
				}

				/* covid19_drug_medicate */
				$covid19_drug_medicate_name = parent::getDrug('covid19');
				if (strlen($x->covid19_drug_medicate_name) > 0) {
					$drug_on_db = explode(',', $x->covid19_drug_medicate_name);
				} else {
					$drug_on_db = array();
				}
				$drug_concat_name = null;
				foreach ($covid19_drug_medicate_name as $key => $value) {
					if (in_array($key, $drug_on_db)) {
						if (is_null($drug_concat_name)) {
							$drug_concat_name = "";
						} else {
							$drug_concat_name = $drug_concat_name.", ";
						}
						$drug_concat_name = $drug_concat_name.$value;
					}
				}

				/* risk_stay_outbreak_country  */
				$risk_stay_outbreak_country = (!empty($x->risk_stay_outbreak_country)) ? $globalCountry[$x->risk_stay_outbreak_country]['country_name_th'] : NULL;
				if (!empty($x->risk_stay_outbreak_city)) {
					$risk_city = self::getCityName($x->risk_stay_outbreak_city);
					$risk_city_name = $risk_city[0]['city_name'];
				} else {
					$risk_city_name = NULL;
				}

				/* treat place */
				if (!empty($x->risk_stay_outbreak_province) || $x->risk_stay_outbreak_province != 0) {
					$risk_stay_outbreak_prov = $provinces[$x->risk_stay_outbreak_province]['province_name'];
				} else {
					$risk_stay_outbreak_prov = NULL;
				}
				if (!empty($x->risk_stay_outbreak_district) || $x->risk_stay_outbreak_district != 0) {
					$risk_stay_outbreak_dist = self::getDistirctNameTh($x->risk_stay_outbreak_district);
					$risk_stay_outbreak_dist_name = $risk_stay_outbreak_dist[0]['district_name'];
				} else {
					$risk_stay_outbreak_dist_name = NULL;
				}
				if (!empty($x->risk_stay_outbreak_sub_district) || $x->risk_stay_outbreak_sub_district != 0) {
					$risk_stay_outbreak_sub_dist = self::getSubDistirctNameTh($x->risk_stay_outbreak_sub_district);
					$risk_stay_outbreak_sub_dist_name = $risk_stay_outbreak_sub_dist[0]['sub_district_name'];
				} else {
					$risk_stay_outbreak_sub_dist_name = NULL;
				}
				if (!empty($x->pt_status) || $x->pt_status != 0 || !is_null($x->pt_status) || isset($x->pt_status)) {
					$ptStatus = 'ok';
				} else {
					$ptStatus = 'xx';
				}
				return [
					'ID' => $x->id,
					'ID Card' => $x->card_id,
					'Passport' => $x->passport,
					'HN' => $x->hn,
					'ชื่อ' => $x->first_name,
					'นามสกุล' => $x->last_name,
					'เพศ' => $x->sex,
					'อายุ' => $x->age,
					'สัญชาติ' => $nation,
					'อาชีพ' => $occupation_name,
					'อาชีพอื่นๆ' => $x->occupation_oth,
					'สถานที่ทำงาน/สถานศึกษา' => $x->work_office,
					'ลักษณะงานที่เสี่ยงติดโรค' => $x->work_contact,
					'โทรศัพท์ที่ติดต่อได้' => $x->work_phone,
					'ที่อยู่ขณะป่วย' => $x->sick_stay_type,
					'ที่อยู่ขณะป่วยอื่นๆ' => $x->sick_stay_type_other,
					'บ้านเลขที่' => $x->sick_house_no,
					'หมู่ที่' => $x->sick_village_no,
					'หมู่บ้าน/ชุมชน' => $x->sick_village,
					'ซอย' => $x->sick_lane,
					'ถนน' => $x->sick_road,
					'จังหวัด' => $sick_prov_name,
					'อำเภอ' => $sick_dist_name,
					'ตำบล' => $sick_sub_dist_name,
					'โรคประจำตัว' => $x->data3_3chk,
					'โรคปอดเรื้อรัง' => $x->data3_3chk_lung,
					'โรคหัวใจ' => $x->data3_3chk_heart,
					'โรคตับเรื้อรัง' => $x->data3_3chk_cirrhosis,
					'โรคไต' => $x->data3_3chk_kidney,
					'เบาหวาน' => $x->data3_3chk_diabetes,
					'ความดันโลหิตสูง' => $x->data3_3chk_blood,
					'ภูมิคุ้มกันบกพร่อง' => $x->data3_3chk_immune,
					'โลหิตจาง' => $x->data3_3chk_anaemia,
					'พิการทางสมอง' => $x->data3_3chk_cerebral,
					'ตั้งครรภ์' => $x->data3_3chk_pregnant,
					'อ้วน' => $x->data3_3chk_fat,
					'มะเร็ง' => $x->data3_3chk_cancer,
					'ชนิดมะเร็ง' => $x->data3_3chk_cancer_name,
					'โรคประจำตัวอื่นๆ' => $x->data3_3chk_other,
					'โรคประจำตัวอื่นๆ ระบุ' => $x->data3_3input_other,
					'วันที่เริ่มป่วย' => $x->data3_1date_sickdate,
					'จังหวัดที่เริ่มป่วย' => $sick_prov_first,
					'อำเภอที่เริ่มป่วย' => $sick_dist_first_name,
					'ตำบลที่เริ่มป่วย' => $sick_sub_dist_name_first,
					'วันที่เข้ารักษาครั้งแรก' => $x->treat_first_date,
					'จังหวัดที่เข้ารักษาครั้งแรก' => $treat_first_prov,
					'อำเภอที่เข้ารักษาครั้งแรก' => $treat_first_dist_name,
					'ตำบลที่เข้ารักษาครั้งแรก' => $treat_first_sub_dist_name,
					'สถานพยาบาลที่รักษาครั้งแรก' => $treat_first_hosp_name,
					'จังหวัดที่รักษาปัจจุบัน' => $treat_place_prov,
					'อำเภอที่รักษาปัจจุบัน' => $treat_place_dist_name,
					'ตำบลที่รักษาปัจจุบัน' => $treat_place_sub_dist_name,
					'สถานที่รักษาปัจจุบัน' => $treat_place_hosp_name,
					'ประวัติมีไข้' => $x->fever_history,
					'อุณหภูมิร่างกายแรกรับ' => $x->body_temperature_first,
					'ความเข้มข้นของ Oxygen' => $x->oxygen_saturate,
					'ไอ' => $x->sym_cough,
					'เจ็บคอ' => $x->sym_sore,
					'ปวดกล้ามเนื้อ' => $x->sym_muscle,
					'มีน้ำมูก' => $x->sym_snot,
					'มีเสมหะ' => $x->sym_sputum,
					'หายใจลำบาก' => $x->sym_breathe,
					'ปวดศีรษะ' => $x->sym_headache,
					'ถ่ายเหลว' => $x->sym_diarrhoea,
					'อาการอื่นๆ' => $x->sym_other,
					'อาการอื่นๆ ระบุ' => $x->sym_othertext,
					'ใส่ท่อช่วยหายใจ' => $x->breathing_tube_chk,
					'วันที่ใส่ท่อช่วยหายใจ' => $x->breathing_tube_date,
					'เอ็กซเรย์ปอด' => $x->lab_cxr1_chk,
					'วันที่เอ็กซเรย์ปอด' => $x->lab_cxr1_date,
					'ผลเอ็กเรย์' => $lab_cxr1_result_name,
					'ผลเอ็กเรย์อื่นๆ' => $x->lab_cxr1_detail,
					'ภาพเอ็กเรย์' => $x->lab_cxr1_file,
					'CBC วันที่' => $x->lab_cbc_date,
					'Hb' => $x->lab_cbc_hb,
					'Hct' => $x->lab_cbc_hct,
					'Platelet count' => $x->lab_cbc_platelet_count,
					'WBC' => $x->lab_cbc_wbc,
					'N' => $x->lab_cbc_neutrophil,
					'L' => $x->lab_cbc_lymphocyte,
					'Atyp lymph' => $x->lab_cbc_atyp_lymph,
					'Mono' => $x->lab_cbc_mono,
					'อื่นๆ ระบุ' => $x->lab_cbc_other,
					'วิธีการตรวจ Influenza test' => $x->lab_rapid_test_method,
					'ตรวจเมื่อวันที่' => $x->lab_rapid_test_date,
					'ผลการตรวจ' => $x->lab_rapid_test_result,
					'Influenza A' => $x->lab_rapid_test_pathogen_flu_a,
					'Influenza B' => $x->lab_rapid_test_pathogen_flu_b,
					'PCR 1 วันที่เก็บ' => $x->lab_sars_cov2_no_1_date,
					'PCR 1 ชนิดตัวอย่าง' => $x->lab_sars_cov2_no_1_specimen,
					'PCR 1 สถานที่ตรวจ' => $x->lab_sars_cov2_no_1_lab,
					'PCR 1 ผลตรวจ' => $x->lab_sars_cov2_no_1_result,
					'PCR 2 วันที่เก็บ' => $x->lab_sars_cov2_no_2_date,
					'PCR 2 ชนิดตัวอย่าง' => $x->lab_sars_cov2_no_2_specimen,
					'PCR 2 สถานที่ตรวจ' => $x->lab_sars_cov2_no_2_lab,
					'PCR 2 ผลตรวจ' => $x->lab_sars_cov2_no_2_result,
					'ประเภทผู้ป่วย' => $x->treat_patient_type,
					'Admited วันที' => $x->treat_place_date,
					'การวินิจฉัยเบื้องต้น' => $x->first_diag,
					'การให้ยารักษาโรคติดเชื้อไวรัสโคโรนา 2019' => $x->covid19_drug_medicate,
					'วันที่ให้ยาโดสแรก' => $x->covid19_drug_medicate_first_date,
					'ชนิดยารักษาโรคติดเชื้อไวรัสโคโรนา 2019' => $drug_concat_name,
					'ยาอื่นๆ ระบุ' => $x->covid19_drug_medicate_name_other,
					'สถานะผู้ป่วย' => $x->patient_treat_status,
					'สถานะอื่นๆ ระบุ' => $x->patient_treat_status_other,
					'ประวัติเสี่ยง' => $x->risk_detail,
					'ประเภทประวัติเสี่ยง' => $x->risk_type,
					'ประเภทประวัติเสี่ยงอื่นๆ' => $x->risk_type_text,
					'ช่วง 14 วันก่อนป่วย ท่านอาศัยอยู่ หรือ มีการเดินทางมาจากพื้นที่ที่มีการระบาด' => $x->risk_stay_outbreak_chk,
					'ประเทศ' => $risk_stay_outbreak_country,
					'เมือง' => $risk_city_name,
					'เมืองอื่นๆ' => $x->risk_stay_outbreak_city_other,
					'วันที่เดินทางไปถึง' => $x->risk_stay_outbreak_arrive_date,
					'วันที่เดินทางมาถึงไทย' => $x->risk_stay_outbreak_arrive_thai_date,
					'สายการบิน' => $x->risk_stay_outbreak_airline,
					'เที่ยวบินที่' => $x->risk_stay_outbreak_flight_no,
					'เลขที่นั่ง' => $x->risk_stay_outbreak_seat_no,
					'จังหวัด' => $risk_stay_outbreak_prov,
					'อำเภอ' => $risk_stay_outbreak_dist_name,
					'ตำบล' => $risk_stay_outbreak_sub_dist_name,
					'ช่วง 14 วันก่อนป่วย ท่านได้เข้ารับการรักษาหรือเยี่ยมผู้ป่วยในโรงพยาบาลของพื้นที่ที่มีการระบาด' => $x->risk_treat_or_visit_patient,
					'ช่วง 14 วันก่อนป่วย ท่านใด้ดูแลหรือสัมผัสใกล้ชิดกับผู้ป่วยอาการคล้ายไข้หวัดใหญ่หรือปอดอักเสบ' => $x->risk_care_flu_patient,
					'ช่วง 14 วันก่อนป่วย ท่านมีประวัติสัมผัสกับผู้ป่วยยืนยันโรคติดเชื้อไวรัสโคโรนา 2019' => $x->risk_contact_covid_19,
					'ชื่อ-นามสกุล' => $x->risk_contact_covid_19_patient_name,
					'รหัส SAT ID' => $x->risk_contact_covid_19_sat_id,
					'ลักษณะการสัมผัส' => $x->risk_contact_covid_19_touch,
					'ช่วงระยะเวลาที่มีการสัมผัส' => $x->risk_contact_covid_19_duration,
					'ช่วง 14 วันก่อนป่วย ท่านประกอบอาชีพที่สัมผัสใกล้ชิดกับนักท่องเที่ยวต่างชาติ' => $x->risk_contact_tourist,
					'ช่วง 14 วันก่อนป่วย ท่านมีประวัติเดินทางไปในสถานที่ที่มีคนหนาแน่น เช่น ผับ สนามมวย' => $x->risk_travel_to_arena,
					'ระบุชื่อสถานที่' => $x->risk_travel_arena_name,
					'เป็นผู้ป่วยอาการทางเดินหายใจหรือปอดอักเสบเป็นกลุ่มก้อน' => $x->be_patient_cluster,
					'เป็นผู้ป่วยปอดอักเสบรุนแรงหรือเสียชีวิตที่หาสาเหตุไม่ได้' => $x->be_patient_critical_unknown_cause,
					'เป็นบุคลากรทางการแพทย์และสาธารณสุขหรือเจ้าหน้าที่ห้องปฏิบัติการ' => $x->be_health_personel,
					'อื่นๆ โปรดระบุ' => $x->risk_other,
					'บันทึกช่วยจำ' => $x->invest_note,
					'ไฟล์สอบสวนโรค' => $x->invest_file,
					'วันที่สอบสวน' => $x->invest_date,
					'สถานะผู้ป่วย' => $ptStatus
				];
			});
			if ($result) {
				$fileExists = Storage::disk('export')->exists($fileName);
				if ($fileExists) {
					$mimetype = Storage::disk('export')->mimeType($fileName);
					$size = Storage::disk('export')->size($fileName);
					$size_kb = ((double)$size/1024);
					$expire_date = date('Y-m-d H:i:s', strtotime('+1 day'));

					$export = LogExport::create([
						'ref_user_id' => auth()->user()->id,
						'file_name' => $fileName,
						'file_imme_type' => $mimetype,
						'file_size' => $size_kb,
						'expire_date' => $expire_date
					]);

					$htm = "<ul style='list-style-type:none;margin:10px 0 0 0;padding:0'>";
					$htm .= "<li><a href='".url("/getFile/{$fileName}")."'>Download your file here. </a></li>";
					$htm .= "<li>Size ".number_format($size_kb, 2, '.', '')." KB</li>";
					$htm .= "<li>IMME Type CSV</li>";
					$htm .= "</ul>";
					return $htm;
				} else {
					$htm = "<ul style='list-style-type:none;margin:10px 0 0 0;padding:0'>";
					$htm .= "<li>File not found.</li>";
					$htm .= "</ul>";
				}
			} else {
				$htm = "<ul style='list-style-type:none;margin:10px 0 0 0;padding:0'>";
				$htm .= "<li>Can not write the file.</li>";
				$htm .= "</ul>";
			}
			return $htm;
		} catch(\Exception $e) {
			Log::error($e->getMessage());
		}
	}

	public function dataGenerator($pt_status, $start_date, $end_date) {
		$user_role = Session::get('user_role');
		$user_hosp = auth()->user()->hospcode;
		$user_prov = auth()->user()->prov_code;
		$user_region = auth()->user()->region;

		$fields = array(
			'id',
			'card_id',
			'passport',
			'hn',
			'first_name',
			'last_name',
			'sex',
			'age',
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
			'invest_note',
			'invest_file',
			'invest_date',
			'pt_status'
		);

		switch ($user_role) {
			case 'root':
				foreach (Invest::select($fields)
					->whereIn('pt_status', $pt_status)
					->whereRaw("(DATE(created_at) BETWEEN '".$start_date."' AND '".$end_date."')")
					->whereNull('deleted_at')
					->cursor() as $data) {
						yield $data;
					}
				break;
			case 'ddc':
				foreach (Invest::select($fields)
					->whereIn('pt_status', $pt_status)
					->whereRaw("(DATE(created_at) BETWEEN '".$start_date."' AND '".$end_date."')")
					->whereNull('deleted_at')
					->cursor() as $data) {
						yield $data;
					}
				break;
			case 'dpc':
				$prov_arr = $this->getProvCodeByRegion($user_region);
				foreach (Invest::select($fields)
					->whereIn('pt_status', $pt_status)
					->whereIn('isolated_province', $prov_arr)
					->whereIn('walkinplace_hosp_province', $prov_arr)
					->whereIn('sick_province', $prov_arr)
					->whereIn('sick_province_first', $prov_arr)
					->whereRaw("(DATE(created_at) BETWEEN '".$start_date."' AND '".$end_date."')")
					->whereNull('deleted_at')
					->cursor() as $data) {
						yield $data;
					}
				break;
			case 'pho':
				foreach (Invest::select($fields)
					->whereIn('pt_status', $pt_status)
					->whereRaw("(isolated_province = '".$user_prov."' OR walkinplace_hosp_province = '".$user_prov."' OR sick_province = '".$user_prov."' OR sick_province_first = '".$user_prov."') AND (DATE(created_at) BETWEEN '".$start_date."' AND '".$end_date."')")
					->whereNull('deleted_at')
					->cursor() as $data) {
						yield $data;
					}
				break;
			case 'hos':
				foreach (Invest::select($fields)
					->whereIn("pt_status", $pt_status)
					->whereRaw("(isolated_hosp_code = '".$user_hosp."' OR walkinplace_hosp_code = '".$user_hosp."') AND (DATE(created_at) BETWEEN '".$start_date."' AND '".$end_date."')")
					->whereNull('deleted_at')
					->cursor() as $data) {
						yield $data;
					}
				break;
			default:
				return redirect()->route('logout');
				break;
		}
	}


	protected function getProvCodeByRegion($region=0) {
		$prov_code = User::select('prov_code')
			->where('region', '=', $region)
			->groupBy('prov_code')
			->get()
			->keyBy('prov_code');
		$prov_code_list = $prov_code->keys()->all();
		return $prov_code_list;
	}

	public function create(Request $request) {
		try {
			/* get default data */
			$titleName = TitleName::all()->keyBy('id')->toArray();
			$provinces = Provinces::all()->sortBy('province_name')->keyBy('province_id')->toArray();
			$globalCountry = GlobalCountry::all()->keyBy('country_id')->toArray();
			$occupation = Occupation::all()->keyBy('id')->toArray();
			$labStation = LabStation::select('id', 'th_name')->get()->keyBy('id')->toArray();
			$ref_specimen = Specimen::select('id', 'name_en')->where('specimen_status', '=', 1)->get()->keyBy('id')->toArray();
			$risk_type = RiskType::all()->keyBy('id')->toArray();

			/* patient data */
			$invest_pt = Invest::where('id', '=', $request->id)->get()->toArray();

			/* map the to patient data */

			if (!is_null($invest_pt[0]['risk_stay_outbreak_city'])) {
				$risk_stay_outbreak_city = GlobalCity::where('city_id', '=', $invest_pt[0]['risk_stay_outbreak_city'])->get()->toArray();
			} else {
				$risk_stay_outbreak_city = null;
			}
			$treat_first_city = !is_null($invest_pt[0]['treat_first_city']) ? GlobalCity::where('city_id', '=', $invest_pt[0]['treat_first_city'])->get()->toArray() : null;
			$treat_place_city = !is_null($invest_pt[0]['treat_place_city']) ? GlobalCity::where('city_id', '=', $invest_pt[0]['treat_place_city'])->get()->toArray() : null;
			$treat_first_hospital = !is_null($invest_pt[0]['treat_first_hospital']) ? Hospitals::where('hospcode', '=', $invest_pt[0]['treat_first_hospital'])->get()->toArray() : null;
			$treat_place_hospital = !is_null($invest_pt[0]['treat_place_hospital']) ? Hospitals::where('hospcode', '=', $invest_pt[0]['treat_place_hospital'])->get()->toArray() : null;

			$pt_activity = PatientActivity::where('ref_patient_id', '=', $invest_pt[0]['id'])->get()->keyBy('day')->toArray();
			if (count($pt_activity) > 0) {
				foreach ($pt_activity as $key => $value) {
					$pt_activity[$key]['date_activity'] = $this->convertMySQLDateFormat($value['date_activity']);
				}
			}

			$covid19_drug_medicate_name = parent::getDrug('covid19');
			/* set drug name to array where edit data */
			if (strlen($invest_pt[0]['covid19_drug_medicate_name']) > 0) {
				$drug_on_db = explode(',', $invest_pt[0]['covid19_drug_medicate_name']);
			} else {
				$drug_on_db = array();
			}
			foreach ($covid19_drug_medicate_name as $key => $value) {
				if (in_array($key, $drug_on_db)) {
					$drug_result[$key] = $key;
				} else {
					$drug_result[$key] = 0;
				}
			}

			$data['breathing_tube_date'] = self::convertMySQLDateFormat($invest_pt[0]['breathing_tube_date']);
			$data['risk_stay_outbreak_arrive_date'] = self::convertMySQLDateFormat($invest_pt[0]['risk_stay_outbreak_arrive_date']);
			$data['risk_stay_outbreak_arrive_thai_date'] = self::convertMySQLDateFormat($invest_pt[0]['risk_stay_outbreak_arrive_thai_date']);
			$data['lab_cbc_date'] = self::convertMySQLDateFormat($invest_pt[0]['lab_cbc_date']);
			$data['lab_cxr1_date'] = self::convertMySQLDateFormat($invest_pt[0]['lab_cxr1_date']);
			$data['lab_rapid_test_date'] = self::convertMySQLDateFormat($invest_pt[0]['lab_rapid_test_date']);
			$data['lab_other_date'] = self::convertMySQLDateFormat($invest_pt[0]['lab_other_date']);
			$data['data3_1date_sickdate'] = self::convertMySQLDateFormat($invest_pt[0]['data3_1date_sickdate']);
			$data['treat_first_date'] = self::convertMySQLDateFormat($invest_pt[0]['treat_first_date']);
			$data['treat_place_date'] = self::convertMySQLDateFormat($invest_pt[0]['treat_place_date']);
			$data['covid19_drug_medicate_first_date'] = self::convertMySQLDateFormat($invest_pt[0]['covid19_drug_medicate_first_date']);
			$data['lab_sars_cov2_no_1_date'] = self::convertMySQLDateFormat($invest_pt[0]['lab_sars_cov2_no_1_date']);
			$data['lab_sars_cov2_no_2_date'] = self::convertMySQLDateFormat($invest_pt[0]['lab_sars_cov2_no_2_date']);
			$data['invest_date'] = self::convertMySQLDateFormat($invest_pt[0]['invest_date']);

			/* sick district */
			if (!empty($invest_pt[0]['sick_district'])) {
				$sick_district = District::where('district_id', '=', $invest_pt[0]['sick_district'])->get()->toArray();
			} else {
				$sick_district = null;
			}

			/* sick sub district */
			if (!empty($invest_pt[0]['sick_sub_district'])) {
				$sick_sub_district = SubDistrict::where('sub_district_id', '=', $invest_pt[0]['sick_sub_district'])->get()->toArray();
			} else {
				$sick_sub_district = null;
			}

			/* sick district first */
			if (!empty($invest_pt[0]['sick_district_first'])) {
				$sick_district_first = District::where('district_id', '=', $invest_pt[0]['sick_district_first'])->get()->toArray();
			} else {
				$sick_district_first = null;
			}

			/* sick sub district first */
			if (!empty($invest_pt[0]['sick_sub_district_first'])) {
				$sick_sub_district_first = SubDistrict::where('sub_district_id', '=', $invest_pt[0]['sick_sub_district_first'])->get()->toArray();
			} else {
				$sick_sub_district_first = null;
			}

			/* risk district */
			if (!empty($invest_pt[0]['risk_stay_outbreak_district'])) {
				$risk_district = District::where('district_id', '=', $invest_pt[0]['risk_stay_outbreak_district'])->get()->toArray();
			} else {
				$risk_district = null;
			}

			/* risk sub district */
			if (!empty($invest_pt[0]['risk_stay_outbreak_sub_district'])) {
				$risk_sub_district = SubDistrict::where('sub_district_id', '=', $invest_pt[0]['risk_stay_outbreak_sub_district'])->get()->toArray();
			} else {
				$risk_sub_district = null;
			}

			/* treaf first district */
			if (!empty($invest_pt[0]['treat_first_district'])) {
				$treat_first_district = District::where('district_id', '=', $invest_pt[0]['treat_first_district'])->get()->toArray();
			} else {
				$treat_first_district = null;
			}

			/* treaf first sub district */
			if (!empty($invest_pt[0]['treat_first_sub_district'])) {
				$treat_first_sub_district = SubDistrict::where('sub_district_id', '=', $invest_pt[0]['treat_first_sub_district'])->get()->toArray();
			} else {
				$treat_first_sub_district = null;
			}

			/* treaf place district */
			if (!empty($invest_pt[0]['treat_place_district'])) {
				$treat_place_district = District::where('district_id', '=', $invest_pt[0]['treat_place_district'])->get()->toArray();
			} else {
				$treat_place_district = null;
			}

			/* treaf place sub district */
			if (!empty($invest_pt[0]['treat_place_sub_district'])) {
				$treat_place_sub_district = SubDistrict::where('sub_district_id', '=', $invest_pt[0]['treat_place_sub_district'])->get()->toArray();
			} else {
				$treat_place_sub_district = null;
			}

			return view('form.invest.index',
				[
					'globalCountry' => $globalCountry,
					'invest_pt' => $invest_pt,
					'risk_stay_outbreak_city' => $risk_stay_outbreak_city,
					'treat_first_city' => $treat_first_city,
					'treat_place_city' => $treat_place_city,
					'treat_first_hospital' => $treat_first_hospital,
					'treat_place_hospital' => $treat_place_hospital,
					'data' => $data,
					'titleName' => $titleName,
					'provinces' => $provinces,
					'occupation' => $occupation,
					'sick_district' => $sick_district,
					'sick_sub_district' => $sick_sub_district,
					'sick_district_first' => $sick_district_first,
					'sick_sub_district_first' => $sick_sub_district_first,
					'risk_district' => $risk_district,
					'risk_sub_district' => $risk_sub_district,
					'treat_first_district' => $treat_first_district,
					'treat_first_sub_district' => $treat_first_sub_district,
					'treat_place_district' => $treat_place_district,
					'treat_place_sub_district' => $treat_place_sub_district,
					'lab_station' => $labStation,
					'ref_specimen' => $ref_specimen,
					'pt_activity' => $pt_activity,
					'covid19_drug_medicate_name' => $covid19_drug_medicate_name,
					'drug_result' => $drug_result,
					'risk_type' => $risk_type

				]
			);
		} catch(\Exception $e) {
			Log::error(sprintf("%s - line %d - ", __FILE__, __LINE__).$e->getMessage());
			// Log::error(sprintf("%s - line %d - Ahihi", __FILE__, __LINE__));
		}
	}

	public function store(Request $request) {
		try {
			$pt = Invest::find($request->id);
			$pt->card_id = $request->idcardInput;
			$pt->passport = $request->passportInput;
			$pt->title_name = $request->titleName;
			$pt->first_name = $request->firstNameInput;
			$pt->last_name = $request->lastNameInput;
			$pt->sex = $request->sexInput;
			$pt->age = $request->ageYearInput;
			$pt->age_month = $request->ageMonthInput;
			$pt->age_days = $request->ageDayInput;
			$pt->nation = $request->nationalityInput;
			$pt->occupation = $request->occupationInput;
			$pt->occupation_oth = $request->occupationOthInput;
			$pt->work_office = $request->workOfficeInput;
			$pt->work_contact = $request->workContactInput;
			$pt->work_phone = $request->workPhoneInput;
			$pt->sick_stay_type = $request->sickStayTypeChk;
			$pt->sick_stay_type_other = $request->sickStayTypeOtherInput;
			$pt->sick_house_no = $request->sickHouseNoInput;
			$pt->sick_village_no = $request->sickVillageNoInput;
			$pt->sick_village = $request->sickVillageInput;
			$pt->sick_lane = $request->sickLaneInput;
			$pt->sick_road = $request->sickRoadInput;
			$pt->sick_province = $request->sickProvinceInput;
			$pt->sick_district = $request->sickDistrictInput;
			$pt->sick_sub_district = $request->sickSubDistrictInput;
			$pt->data3_3chk_heart = $request->data3_3chk_heart;
			$pt->data3_3chk_cirrhosis = $request->data3_3chk_cirrhosis;
			$pt->data3_3chk_kidney = $request->data3_3chk_kidney;
			$pt->data3_3chk_cerebral = $request->data3_3chk_cerebral;
			$pt->data3_3chk_pregnant = $request->data3_3chk_pregnant;
			$pt->data3_3chk_cancer = $request->data3_3chk_cancer;
			$pt->data3_3chk_cancer_name = $request->data3_3chk_cancer_name;

			$pt->data3_1date_sickdate = $this->convertDateToMySQL($request->data3_1date_sickdate);
			$pt->sick_province_first = $request->sick_province_first;
			$pt->sick_district_first = $request->sick_district_first;
			$pt->sick_sub_district_first = $request->sick_sub_district_first;
			$pt->treat_first_date = $this->convertDateToMySQL($request->treat_first_date);
			$pt->treat_first_province = $request->treatFirstProvinceInput;
			$pt->treat_first_district = $request->treatFirstDistrictInput;
			$pt->treat_first_sub_district = $request->treatFirstSubDistrictInput;
			$pt->treat_first_hospital = $request->treat_first_hospital;
			$pt->treat_place_province = $request->treatPlaceProvinceInput;
			$pt->treat_place_district = $request->treatPlaceDistrictInput;
			$pt->treat_place_sub_district = $request->treatPlaceSubDistrictInput;
			$pt->treat_place_hospital = $request->treat_place_hospital;
			$pt->fever_history = $request->fever_history;
			$pt->body_temperature_first = $request->body_temperature_first;
			$pt->oxygen_saturate = $request->oxygen_saturate;
			$pt->sym_cough = $request->sym_cough;
			$pt->sym_sore = $request->sym_sore;
			$pt->sym_muscle = $request->sym_muscle;
			$pt->sym_snot = $request->sym_snot;
			$pt->sym_sputum = $request->sym_sputum;
			$pt->sym_breathe = $request->sym_breathe;
			$pt->sym_headache = $request->sym_headache;
			$pt->sym_diarrhoea = $request->sym_diarrhoea;
			$pt->sym_other = $request->sym_other;
			$pt->sym_othertext = $request->sym_other_text;
			$pt->breathing_tube_chk = $request->breathingTubeChk;
			$pt->breathing_tube_date = $this->convertDateToMySQL($request->breathing_tube_date);
			$pt->lab_cxr1_chk = $request->lab_cxr1_chk;
			$pt->lab_cxr1_date = $this->convertDateToMySQL($request->labCxr1Date);
			$pt->lab_cxr1_result = $request->labCxr1Result;
			$pt->lab_cxr1_detail = $request->labCxr1Detail;

			if (Input::hasFile('labCxr1File')) {
				$lab_file1_new_name = 'cxr1_file_cid'.$request->id;
				$lab_file1_extension = Input::file('labCxr1File')->getClientOriginalExtension();
				$fileName1 = $lab_file1_new_name.'.'.$lab_file1_extension;
				$pt->lab_cxr1_file = $fileName1;
				Storage::disk('invest')->put($fileName1, File::get(Input::file('labCxr1File')));
			}

			$pt->lab_cbc_date = $this->convertDateToMySQL($request->labCbcDate);
			$pt->lab_cbc_hb = $request->labCbcHb;
			$pt->lab_cbc_hct = $request->labCbcHct;
			$pt->lab_cbc_platelet_count = $request->labCbcPlateletCount;
			$pt->lab_cbc_wbc = $request->labCbcWbc;
			$pt->lab_cbc_neutrophil = $request->labCbcNeutrophil;
			$pt->lab_cbc_lymphocyte = $request->labCbcLymphocyte;
			$pt->lab_cbc_atyp_lymph = $request->lab_cbc_atyp_lymph;
			$pt->lab_cbc_mono = $request->lab_cbc_mono;
			$pt->lab_cbc_other = $request->lab_cbc_other;
			$pt->lab_rapid_test_method = $request->lab_rapid_test_method;
			$pt->lab_rapid_test_date = $this->convertDateToMySQL($request->labRapidTestDate);
			$pt->lab_rapid_test_result = $request->labRapidTestResult;
			$pt->lab_rapid_test_pathogen_flu_a = $request->lab_rapid_test_pathogen_flu_a;
			$pt->lab_rapid_test_pathogen_flu_b = $request->lab_rapid_test_pathogen_flu_b;

			$pt->lab_sars_cov2_no_1 = 1;
			$pt->lab_sars_cov2_no_1_date = $this->convertDateToMySQL($request->lab_sars_cov2_no_1_date);
			$pt->lab_sars_cov2_no_1_specimen = $request->lab_sars_cov2_no_1_specimen;
			$pt->lab_sars_cov2_no_1_lab = $request->lab_sars_cov2_no_1_lab;
			$pt->lab_sars_cov2_no_1_result = $request->lab_sars_cov2_no_1_result;
			$pt->lab_sars_cov2_no_2 = 2;
			$pt->lab_sars_cov2_no_2_date = $this->convertDateToMySQL($request->lab_sars_cov2_no_2_date);
			$pt->lab_sars_cov2_no_2_specimen = $request->lab_sars_cov2_no_2_specimen;
			$pt->lab_sars_cov2_no_2_lab = $request->lab_sars_cov2_no_2_lab;
			$pt->lab_sars_cov2_no_2_result = $request->lab_sars_cov2_no_2_result;
			$pt->treat_patient_type = $request->treat_patient_type;
			$pt->treat_place_date = $this->convertDateToMySQL($request->treat_place_date);
			$pt->first_diag = $request->firstDiagInput;
			$pt->covid19_drug_medicate = $request->covid19Drugchk;
			$pt->covid19_drug_medicate_first_date = $this->convertDateToMySQL($request->covid19_drug_medicate_first_date);

			/* set drug name to array */
			$drugStr = NULL;
			if (!is_null($request->covid19_drug_medicate_name) || $request->covid19_drug_medicate_name != "") {
				foreach ($request->covid19_drug_medicate_name as $key => $value) {
					if (is_null($drugStr)) {
						$drugStr = "";
					} else {
						$drugStr = $drugStr.",";
					}
					$drugStr = $drugStr.$value;
				}
			}
			$pt->covid19_drug_medicate_name = $drugStr;

			$pt->covid19_drug_medicate_name_other = $request->covid19_drug_medicate_name_other;
			$pt->patient_treat_status = $request->patientTreatStatus;
			$pt->patient_treat_status_refer = $request->patient_treat_status_refer;
			$pt->patient_treat_status_other = $request->patient_treat_status_other;
			$pt->data3_3chk = $request->data3_3chk;
			$pt->data3_3chk_lung = $request->data3_3chk_lung;
			$pt->data3_3chk_diabetes = $request->data3_3chk_diabetes;
			$pt->data3_3chk_blood = $request->data3_3chk_blood;
			$pt->data3_3chk_immune = $request->data3_3chk_immune;
			$pt->data3_3chk_anaemia = $request->data3_3chk_anaemia;
			$pt->data3_3chk_fat = $request->data3_3chk_fat;
			$pt->data3_3chk_other = $request->data3_3chk_other;
			$pt->data3_3input_other = $request->data3_3input_other;
			$pt->risk_stay_outbreak_chk = $request->riskStayOutbreakChk;
			$pt->risk_stay_outbreak_country = $request->riskStayOutbreakCountryInput;
			$pt->risk_stay_outbreak_city = $request->riskStayOutbreakCityInput;
			$pt->risk_stay_outbreak_city_other = $request->riskStayOutbreakCityOtherInput;
			$pt->risk_stay_outbreak_arrive_date = $this->convertDateToMySQL($request->riskStayOutbreakArriveDate);
			$pt->risk_stay_outbreak_arrive_thai_date = $this->convertDateToMySQL($request->riskStayOutbreakArriveThaiDate);
			$pt->risk_stay_outbreak_airline = $request->riskStayOutbreakAirline;
			$pt->risk_stay_outbreak_flight_no = $request->riskStayOutbreakFlightNoInput;
			$pt->risk_stay_outbreak_seat_no = $request->riskStayOutbreakSeatNoInput;
			$pt->risk_stay_outbreak_province = $request->riskStayOutbreakProvinceInput;
			$pt->risk_stay_outbreak_district = $request->riskStayOutbreakDistrictInput;
			$pt->risk_stay_outbreak_sub_district = $request->riskStayOutbreakSubDistrictInput;
			$pt->risk_treat_or_visit_patient = $request->riskTreatOrVisitPatient;
			$pt->risk_care_flu_patient = $request->riskCareFluPatient;
			$pt->risk_contact_covid_19 = $request->risk_contact_covid_19;
			$pt->risk_contact_covid_19_patient_name = $request->risk_contact_covid_19_patient_name;
			$pt->risk_contact_covid_19_sat_id = $request->risk_contact_covid_19_sat_id;
			$pt->risk_contact_covid_19_touch = $request->risk_contact_covid_19_touch;
			$pt->risk_contact_covid_19_duration = $request->risk_contact_covid_19_duration;
			$pt->risk_contact_tourist = $request->risk_contact_tourist;
			$pt->risk_travel_to_arena = $request->risk_travel_to_arena;
			$pt->risk_travel_arena_name = $request->risk_travel_arena_name;
			$pt->be_patient_cluster = $request->be_patient_cluster;
			$pt->be_patient_critical_unknown_cause = $request->be_patient_critical_unknown_cause;
			$pt->be_health_personel = $request->be_health_personel;
			$pt->risk_other = $request->risk_other;
			$pt->invest_date =  $this->convertDateToMySQL($request->invest_date);
			$pt->risk_detail = $request->risk_detail;
			$pt->risk_type = $request->risk_type;
			$pt->risk_type_text = $request->risk_type_text;
			$pt->entry_user_last_update = auth()->user()->id;
			$pt->invest_note = $request->invest_note;

			if (Input::hasFile('invest_file')) {
				$inv_file_new_name = 'inv_file_cid'.$request->id;
				$inv_file_extension = Input::file('invest_file')->getClientOriginalExtension();
				$inv_file_name = $inv_file_new_name.'.'.$inv_file_extension;
				$pt->invest_file = $inv_file_name;
				Storage::disk('invest')->put($inv_file_name, File::get(Input::file('invest_file')));
			}

			for ($i=1; $i<=10; $i++) {
				$activityDate = $request->input('activityDate'.$i);
				if (!empty($activityDate) || $activityDate != NULL) {
					$p2['ref_patient_id'] = $request->id;
					$p2['day'] = $request->input('acc_day'.$i);
					$p2['date_activity'] = $this->convertDateToMySQL($activityDate);
					$p2['activity'] = $request->input('activity'.$i);
					$p2['place'] = $request->input('activityPlace'.$i);
					$p2['personal_amount'] = $request->input('activityAmount'.$i);
					$p2['personal_name'] = $request->input('activityName'.$i);
					$p1['id'] = $request->input('idx'.$i);
					$act_saved = PatientActivity::updateOrCreate($p1, $p2);
				} else {
					continue;
				}
			}

			$pt_saved = $pt->save();
			if ($pt_saved) {
				flash()->overlay('<i class="fas fa-check-circle text-success"></i> บันทึกข้อมูลสำเร็จแล้ว', 'DDC::Covid-19');
				return redirect()->route('list-data.invest');
			}
		} catch(\Exception $e) {
			Log::error(sprintf("%s - line %d - ", __FILE__, __LINE__).$e->getMessage());
			//Log::error(sprintf("%s - line %d - Ahihi", __FILE__, __LINE__));
		}
	}

	public function hospitalByProv($prov_code=0) {
		return DB::connection('mysql')
			->table('chospital_new')
			->select('hospcode', 'hosp_name')
			->where('prov_code', '=', $prov_code)
			->where('status_code', '=', '1')
			->orderBy('hosp_name', 'asc')
			->get();
	}

	public function hospitalFetch(Request $request) {
		$coll = $this->hospitalByProv($request->pid);
		$hospitals = $coll->keyBy('hospcode');
		$htm = "<option value=\"0\">-- โปรดเลือก --</option>";
		foreach ($hospitals as $key => $val) {
			$htm .= "<option value=\"".$val->hospcode."\">".$val->hosp_name."</option>";
		}
		return $htm;
	}

	protected function getHospitalNameTh($hosp_code=0) {
		if (!empty($hosp_code) || $hosp_code != 0) {
			$hosp_name = Hospitals::select('hosp_name')
				->where('hospcode', '=', $hosp_code)
				->get()
				->toArray();
		} else {
			$hosp_name = null;
		}
		return $hosp_name;
	}

	protected function getCityName($city_id=0) {
		if (!empty($city_id) || $city_id != 0) {
			$city_name = GlobalCity::select('city_name')
				->where('city_id', '=', $city_id)
				->get()
				->toArray();
		} else {
			$city_name = null;
		}
		return $city_name;
	}

	public function districtByProv($prov_code=0) {
		return DB::connection('mysql')
			->table('ref_district')
			->where('province_id', '=', $prov_code)
			->orderBy('district_id', 'asc')
			->get();
	}

	public function subDistrictByDistrict($dist_code=0) {
		return DB::connection('mysql')
			->table('ref_sub_district')
			->where('district_id', '=', $dist_code)
			->orderBy('sub_district_id', 'asc')
			->get();
	}

	protected function getDistirctNameTh($dist_code=0) {
		if (!empty($dist_code) || $dist_code != 0) {
			$dist_name = District::select('district_name')
				->where('district_id', '=', $dist_code)
				->get()
				->toArray();
		} else {
			$dist_name = null;
		}
		return $dist_name;
	}

	protected function getSubDistirctNameTh($sub_dist_code=0) {
		if (!empty($sub_dist_code) || $sub_dist_code != 0) {
			$sub_dist_name = SubDistrict::select('sub_district_name')
			->where('sub_district_id', '=', $sub_dist_code)
			->get()
			->toArray();
		} else {
			$sub_dist_name = null;
		}
		return $sub_dist_name;
	}

	public function districtFetch(Request $request) {
		$coll = self::districtByProv($request->id);
		$districts = $coll->keyBy('district_id');
		$htm = "<option value=\"0\">-- โปรดเลือก --</option>";
		foreach ($districts as $key => $val) {
			$htm .= "<option value=\"".$val->district_id."\">".$val->district_name."</option>";
		}
		return $htm;
	}

	public static function cityFetch(Request $request) {
		$coll = GlobalCity::where('country_id', '=', $request->id)->get();
		$htm = "<option value=\"0\">-- โปรดเลือก --</option>";
		foreach ($coll as $key => $val) {
			$htm .= "<option value=\"".$val->city_id."\">".$val->city_name."</option>";
		}
		return $htm;
	}

	public function subDistrictFetch(Request $request) {
		$coll = self::subDistrictByDistrict($request->id);
		$sub_districts = $coll->keyBy('sub_district_id');
		$htm = "<option value=\"0\">-- โปรดเลือก --</option>";
		foreach ($sub_districts as $key => $val) {
			$htm .= "<option value=\"".$val->sub_district_id."\">".$val->sub_district_name."</option>";
		}
		return $htm;
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

	protected function convertMySQLDateFormat($date='00-00-0000', $seperator="/") {
		if (!is_null($date) || !empty($date)) {
			$ep = explode("-", $date);
			$string = $ep[2].$seperator.$ep[1].$seperator.$ep[0];
		} else {
			$string = NULL;
		}
		return $string;
	}
}

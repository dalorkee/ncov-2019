<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
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
use App\Port;
use Illuminate\Support\Facades\Log;
use Rap2hpoutre\FastExcel\FastExcel;
use Carbon\Carbon;
use App\FilesUpload;


class InvestController extends MasterController
{
	public function __construct() {
		$this->middleware('auth');
		$this->middleware('onlyOneUser');
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

	protected function setDateRange($date_range) {
		$exp = explode("/", $date_range);
		$result = $exp[2].'-'.$exp[0].'-'.$exp[1];
		return $result;
	}

	public function downloadInvestFile($pt_id=null) {
		$fileName = Invest::select('invest_file')->where('id', '=', $pt_id)->get();
		if (!is_null($fileName[0]->invest_file)) {
			if (Storage::disk('invest')->exists($fileName[0]->invest_file)) {
				//return Storage::disk('invest')->download($fileName[0]->invest_file);
				$filePath = public_path('files/invest/'.$fileName[0]->invest_file);
				return response()->download($filePath);
			} else {
				return '<div>File not exists.</div>';
			}
		} else {
			return '<div>File variable is null.</div>';
		}
	}

	public function downloadXrayFile($pt_id=null) {
		$fileName = Invest::select('lab_cxr1_file')->where('id', '=', $pt_id)->get();
		if (!is_null($fileName[0]->lab_cxr1_file)) {
			if (Storage::disk('invest')->exists($fileName[0]->lab_cxr1_file)) {
				//return Storage::disk('invest')->download($fileName[0]->invest_file);
				$filePath = public_path('files/invest/'.$fileName[0]->lab_cxr1_file);
				return response()->download($filePath);
			} else {
				return '<div>File not exists.</div>';
			}
		} else {
			return '<div>File variable is null.</div>';
		}
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
			$lab_status = parent::selectStatus('lab_status');
			$screen_pt = parent::selectStatus('screen_pt');
			$healthCoverage = parent::selectStatus('health_coverage');

			/* patient data */
			$invest_pt = Invest::where('id', '=', $request->id)->get()->toArray();
			if (count($invest_pt) > 0) {
				/* map to patient data */
				if (empty($invest_pt[0]['risk_stay_outbreak_city']) || is_null($invest_pt[0]['risk_stay_outbreak_city']) || $invest_pt[0]['risk_stay_outbreak_city'] == '0') {
					$risk_stay_outbreak_city = null;
				} else {
					$risk_stay_outbreak_city = GlobalCity::where('city_id', '=', $invest_pt[0]['risk_stay_outbreak_city'])->get()->toArray();
					if (count($risk_stay_outbreak_city) <= 0) {
						Log::warning('risk_stay_outbreak_city field not match - uid:  '.auth()->user()->id.' - pid: '.$request->id);
					}
				}

				if (empty($invest_pt[0]['treat_first_city']) || is_null($invest_pt[0]['treat_first_city']) || $invest_pt[0]['treat_first_city'] == '0') {
					$treat_first_city = null;
				} else {
					$treat_first_city = GlobalCity::where('city_id', '=', $invest_pt[0]['treat_first_city'])->get()->toArray();
					if (count($treat_first_city) <= 0) {
						Log::warning('treat_first_city field not match - uid:  '.auth()->user()->id.' - pid: '.$request->id);
					}
				}

				if (empty($invest_pt[0]['treat_place_city']) || is_null($invest_pt[0]['treat_place_city']) || $invest_pt[0]['treat_place_city'] == '0') {
					$treat_place_city = null;
				} else {
					$treat_place_city = GlobalCity::where('city_id', '=', $invest_pt[0]['treat_place_city'])->get()->toArray();
					if (count($treat_place_city) <= 0) {
						Log::warning('treat_place_city field not match - uid:  '.auth()->user()->id.' - pid: '.$request->id);
					}
				}

				if (empty($invest_pt[0]['treat_first_hospital']) || is_null($invest_pt[0]['treat_first_hospital']) || $invest_pt[0]['treat_first_hospital'] == '0') {
					$treat_first_hospital = null;
				} else {
					$treat_first_hospital =  Hospitals::where('hospcode', '=', $invest_pt[0]['treat_first_hospital'])->get()->toArray();
					if (count($treat_first_hospital) <= 0) {
						Log::warning('treat_first_hospital field not match - uid:  '.auth()->user()->id.' - pid: '.$request->id);
					}
				}

				if (empty($invest_pt[0]['treat_place_hospital']) || is_null($invest_pt[0]['treat_place_hospital']) || $invest_pt[0]['treat_place_hospital'] == '0') {
					$treat_place_hospital = null;
				} else {
					$treat_place_hospital = Hospitals::where('hospcode', '=', $invest_pt[0]['treat_place_hospital'])->get()->toArray();
					if (count($treat_place_hospital) <= 0) {
						Log::warning('treat_place_hospital field not match - uid:  '.auth()->user()->id.' - pid: '.$request->id);
					}
				}

				if (empty($invest_pt[0]['patient_treat_status_refer']) || is_null($invest_pt[0]['patient_treat_status_refer']) || $invest_pt[0]['patient_treat_status_refer'] == '0') {
					$patient_treat_status_refer = null;
				} else {
					$patient_treat_status_refer = Hospitals::where('hospcode', '=', $invest_pt[0]['patient_treat_status_refer'])->get()->toArray();
					if (count($patient_treat_status_refer) <= 0) {
						Log::warning('patient_treat_status_refer field not match - uid:  '.auth()->user()->id.' - pid: '.$request->id);
					}
				}

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
				$data['patient_treat_status_refer_date'] = self::convertMySQLDateFormat($invest_pt[0]['patient_treat_status_refer_date']);

				/* sick district */
				if (empty($invest_pt[0]['sick_district']) || is_null($invest_pt[0]['sick_district']) || $invest_pt[0]['sick_district'] == '0') {
					$sick_district = null;
				} else {
					$sick_district = District::where('district_id', '=', $invest_pt[0]['sick_district'])->get()->toArray();
					if (count($sick_district) <= 0) {
						Log::warning('sick_district field not match - uid:  '.auth()->user()->id.' - pid: '.$request->id);
					}
				}

				/* sick sub district */
				if (empty($invest_pt[0]['sick_sub_district']) || is_null($invest_pt[0]['sick_sub_district']) || $invest_pt[0]['sick_sub_district'] == '0') {
					$sick_sub_district = null;
				} else {
					$sick_sub_district = SubDistrict::where('sub_district_id', '=', $invest_pt[0]['sick_sub_district'])->get()->toArray();
					if (count($sick_sub_district) <= 0) {
						Log::warning('sick_sub_district field not match - uid: '.auth()->user()->id.' - pid: '.$request->id);
					}
				}

				/* sick district first */
				if (empty($invest_pt[0]['sick_district_first']) || is_null($invest_pt[0]['sick_district_first']) || $invest_pt[0]['sick_district_first'] == '0') {
					$sick_district_first = null;
				} else {
					$sick_district_first = District::where('district_id', '=', $invest_pt[0]['sick_district_first'])->get()->toArray();
					if (count($sick_district_first) <= 0) {
						Log::warning('sick_district_first field not match - uid: '.auth()->user()->id.' - pid: '.$request->id);
					}
				}

				/* sick sub district first */
				if (empty($invest_pt[0]['sick_sub_district_first']) || is_null($invest_pt[0]['sick_sub_district_first']) || $invest_pt[0]['sick_sub_district_first'] == '0') {
					$sick_sub_district_first = null;
				} else {
					$sick_sub_district_first = SubDistrict::where('sub_district_id', '=', $invest_pt[0]['sick_sub_district_first'])->get()->toArray();
					if (count($sick_sub_district_first) <= 0) {
						Log::warning('sick_sub_district_first field not match - uid: '.auth()->user()->id.' - pid: '.$request->id);
					}
				}

				/* risk district */
				if (empty($invest_pt[0]['risk_stay_outbreak_district']) || is_null($invest_pt[0]['risk_stay_outbreak_district']) || $invest_pt[0]['risk_stay_outbreak_district'] == '0') {
					$risk_district = null;
				} else {
					$risk_district = District::where('district_id', '=', $invest_pt[0]['risk_stay_outbreak_district'])->get()->toArray();
					if (count($risk_district) <= 0) {
						Log::warning('risk_stay_outbreak_district field not match - uid: '.auth()->user()->id.' - pid: '.$request->id);
					}
				}

				/* risk sub district */
				if (empty($invest_pt[0]['risk_stay_outbreak_sub_district']) || is_null($invest_pt[0]['risk_stay_outbreak_sub_district']) || $invest_pt[0]['risk_stay_outbreak_sub_district'] == '0') {
					$risk_sub_district = null;
				} else {
					$risk_sub_district = SubDistrict::where('sub_district_id', '=', $invest_pt[0]['risk_stay_outbreak_sub_district'])->get()->toArray();
					if (count($risk_sub_district) <= 0) {
						Log::warning('risk_stay_outbreak_sub_district field not match - uid: '.auth()->user()->id.' - pid: '.$request->id);
					}
				}

				/* treaf first district */
				if (empty($invest_pt[0]['treat_first_district']) || is_null($invest_pt[0]['treat_first_district']) || $invest_pt[0]['treat_first_district'] == '0') {
					$treat_first_district = null;
				} else {
					$treat_first_district = District::where('district_id', '=', $invest_pt[0]['treat_first_district'])->get()->toArray();
					if (count($treat_first_district) <= 0) {
						Log::warning('treat_first_district field not match - uid: '.auth()->user()->id.' - pid: '.$request->id);
					}
				}

				/* treaf first sub district */
				if (empty($invest_pt[0]['treat_first_sub_district']) || is_null($invest_pt[0]['treat_first_sub_district']) || $invest_pt[0]['treat_first_sub_district'] == '0') {
					$treat_first_sub_district = null;
				} else {
					$treat_first_sub_district = SubDistrict::where('sub_district_id', '=', $invest_pt[0]['treat_first_sub_district'])->get()->toArray();
					if (count($treat_first_sub_district) <= 0) {
						Log::warning('treat_first_sub_district field not match - uid: '.auth()->user()->id.' - pid: '.$request->id);
					}
				}

				/* treaf place district */
				if (empty($invest_pt[0]['treat_place_district']) || is_null($invest_pt[0]['treat_place_district']) || $invest_pt[0]['treat_place_district'] == '0') {
					$treat_place_district = null;
				} else {
					$treat_place_district = District::where('district_id', '=', $invest_pt[0]['treat_place_district'])->get()->toArray();
					if (count($treat_place_district) <= 0) {
						Log::warning('treat_place_district field not match - uid: '.auth()->user()->id.' - pid: '.$request->id);
					}
				}

				/* treaf place sub district */
				if (empty($invest_pt[0]['treat_place_sub_district']) || is_null($invest_pt[0]['treat_place_sub_district']) || $invest_pt[0]['treat_place_sub_district'] == '0') {
					$treat_place_sub_district = null;
				} else {
					$treat_place_sub_district = SubDistrict::where('sub_district_id', '=', $invest_pt[0]['treat_place_sub_district'])->get()->toArray();
					if (count($treat_place_sub_district) <= 0) {
						Log::warning('treat_place_sub_district field not match - uid: '.auth()->user()->id.' - pid: '.$request->id);
					}
				}

				/* patient_treat_status_refer_district */
				if (empty($invest_pt[0]['patient_treat_status_refer_district']) || is_null($invest_pt[0]['patient_treat_status_refer_district']) || $invest_pt[0]['patient_treat_status_refer_district'] == '0') {
					$patient_treat_status_refer_district = null;
				} else {
					$patient_treat_status_refer_district = District::where('district_id', '=', $invest_pt[0]['patient_treat_status_refer_district'])->get()->toArray();
					if (count($patient_treat_status_refer_district) <= 0) {
						Log::warning('patient_treat_status_refer_district field not match - uid: '.auth()->user()->id.' - pid: '.$request->id);
					}
				}

				/* patient_treat_status_refer_sub_district */
				if (empty($invest_pt[0]['patient_treat_status_refer_sub_district']) || is_null($invest_pt[0]['patient_treat_status_refer_sub_district']) || $invest_pt[0]['patient_treat_status_refer_sub_district'] == '0') {
					$patient_treat_status_refer_sub_district = null;
				} else {
					$patient_treat_status_refer_sub_district = SubDistrict::where('sub_district_id', '=', $invest_pt[0]['patient_treat_status_refer_sub_district'])->get()->toArray();
					if (count($patient_treat_status_refer_sub_district) <= 0) {
						Log::warning('patient_treat_status_refer_sub_district field not match - uid: '.auth()->user()->id.' - pid: '.$request->id);
					}
				}

				/* invest attach file */
				/*
				if (empty($invest_pt[0]['invest_file']) || is_null($invest_pt[0]['invest_file']) || $invest_pt[0]['invest_file'] == '0') {
					$invest_file_size = null;
				} else {
					if (Storage::disk('invest')->exists($invest_pt[0]['invest_file'])) {
						$invest_file_size = Storage::disk('invest')->size($invest_pt[0]['invest_file']);
						$invest_file_size = ($invest_file_size/1024);
					} else {
						$invest_file_size = null;
					}
				}
				*/
				/* x-ray invest attach file */
				/*if (empty($invest_pt[0]['lab_cxr1_file']) || is_null($invest_pt[0]['lab_cxr1_file']) || $invest_pt[0]['lab_cxr1_file'] == '0') {
					$xray_file_size = null;
				} else {
					if (Storage::disk('invest')->exists($invest_pt[0]['lab_cxr1_file'])) {
						$xray_file_size = Storage::disk('invest')->size($invest_pt[0]['lab_cxr1_file']);
						$xray_file_size = ($xray_file_size/1024);
					} else {
						$xray_file_size = null;
					}
				}
				*/

				/* get last log refer */
				return view('form.invest.index',
					[
						'globalCountry' => $globalCountry,
						'invest_pt' => $invest_pt,
						'risk_stay_outbreak_city' => $risk_stay_outbreak_city,
						'treat_first_city' => $treat_first_city,
						'treat_place_city' => $treat_place_city,
						'treat_first_hospital' => $treat_first_hospital,
						'treat_place_hospital' => $treat_place_hospital,
						'patient_treat_status_refer' => $patient_treat_status_refer,
						'healthCoverage' => $healthCoverage,
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
						'risk_type' => $risk_type,
						//'invest_file_size' => $invest_file_size,
						//'xray_file_size' => $xray_file_size,
						'refer_district' => $patient_treat_status_refer_district,
						'refer_sub_district' => $patient_treat_status_refer_sub_district,
						'lab_status' => $lab_status,
						'screen_pt' => $screen_pt
					]
				);
			} else {
				return redirect()->back()->with('error', 'ไม่พบข้อมูล');
			}
		} catch(\Exception $e) {
			Log::error(sprintf("%s - line %d - ", __FILE__, __LINE__).$e->getMessage());
		}
	}

	public function store(Request $request) {
		/* validate */
		$request->validate([
			'idcardInput' => 'nullable|numeric|digits:13',
			'passportInput' => 'nullable|max:40',
			'hn' => 'nullable|max:30',
			'firstNameInput' => 'max:50',
			'lastNameInput' => 'max:100',
			'ageYearInput' => 'nullable|numeric|max:120',
			'ageMonthInput' => 'nullable|numeric|max:12',
			'ageDayInput' => 'nullable|numeric|max:31',
			'occupationOthInput' => 'max:100',
			'workOfficeInput' => 'max:100',
			'workContactInput' => 'max:200',
			'workPhoneInput' => 'max:50',
			'sickStayTypeOtherInput' => 'max:200',
			'sickHouseNoInput' => 'max:200',
			'sickVillageNoInput' => 'max:100',
			'sickVillageInput' => 'max:100',
			'sickLaneInput' => 'max:100',
			'sickRoadInput' => 'max:100',
			'data3_3chk_cancer_name' => 'max:100',
			'data3_3input_other' => 'max:250',
			'body_temperature_first' => 'max:30',
			'oxygen_saturate' => 'max:30',
			'sym_other_text' => 'max:30000',
			'labCxr1Detail' => 'max:30000',
			'labCbcHb' => 'nullable|max:100',
			'labCbcHct' => 'nullable|max:100',
			'labCbcPlateletCount' => 'nullable|max:100',
			'labCbcWbc' => 'nullable|max:100',
			'labCbcNeutrophil' => 'nullable|max:100',
			'labCbcLymphocyte' => 'nullable|max:100',
			'lab_cbc_atyp_lymph' => 'nullable|max:100',
			'lab_cbc_mono' => 'nullable|max:100',
			'lab_cbc_other' => 'max:250',
			'lab_rapid_test_method' => 'max:50',
			'firstDiagInput' => 'max:5000',
			'covid19_drug_medicate_name_other' => 'max:250',
			'patient_treat_status_refer' => 'max:250',
			'patient_treat_status_other' => 'max:250',
			'risk_detail' => 'max:30000',
			'risk_type_text' => 'max:30000',
			'riskStayOutbreakAirline' => 'max:30',
			'riskStayOutbreakFlightNoInput' => 'max:20',
			'riskStayOutbreakSeatNoInput' => 'max:20',
			'risk_contact_covid_19_patient_name' => 'max:200',
			'risk_contact_covid_19_sat_id' => 'max:250',
			'risk_contact_covid_19_touch' => 'max:1000',
			'risk_contact_covid_19_duration' => 'max:150',
			'risk_travel_arena_name' => 'max:255',
			'risk_other' => 'max:30000',
			'invest_note' => 'max:30000',
		],[
			'idcardInput.numeric' => 'หมายเลขบัตรประจำตัวประชาชนต้องเป็นตัวเลข',
			'idcardInput.digits' => 'หมายเลขบัตรประจำตัวประชาชนต้องมี 13 หลัก',
			'passportInput.max' => 'หมายเลขพาสปอร์ตต้องไม่เกิน 20 หลัก'
		]);
		try {
			/* store data */
			$pt = Invest::find($request->id);
			$pt->card_id = $request->idcardInput;
			$pt->passport = $request->passportInput;
			$pt->hn = $request->hn;
			$pt->title_name = ($request->titleName != '0') ? $request->titleName : NULL;
			$pt->first_name = $request->firstNameInput;
			$pt->last_name = $request->lastNameInput;
			$pt->sex = ($request->sexInput != '0') ? $request->sexInput : NULL;
			$pt->age = $request->ageYearInput;
			$pt->age_month = $request->ageMonthInput;
			$pt->age_days = $request->ageDayInput;
			$pt->nation = ($request->nationalityInput != '0') ? $request->nationalityInput : NULL;
			$pt->occupation = ($request->occupationInput != '0') ? $request->occupationInput : NULL;
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
			$pt->sick_province = ($request->sickProvinceInput != '0') ? $request->sickProvinceInput : NULL;
			$pt->sick_district = ($request->sickDistrictInput != '0') ? $request->sickDistrictInput : NULL;
			$pt->sick_sub_district = ($request->sickSubDistrictInput != '0') ? $request->sickSubDistrictInput : NULL;
			$pt->data3_3chk_heart = $request->data3_3chk_heart;
			$pt->data3_3chk_cirrhosis = $request->data3_3chk_cirrhosis;
			$pt->data3_3chk_kidney = $request->data3_3chk_kidney;
			$pt->data3_3chk_cerebral = $request->data3_3chk_cerebral;
			$pt->data3_3chk_pregnant = $request->data3_3chk_pregnant;
			$pt->data3_3chk_cancer = $request->data3_3chk_cancer;
			$pt->data3_3chk_cancer_name = $request->data3_3chk_cancer_name;
			$pt->screen_pt = $request->screen_pt;

			$pt->data3_1date_sickdate = $this->convertDateToMySQL($request->data3_1date_sickdate);
			$pt->sick_province_first = ($request->sick_province_first != '0') ? $request->sick_province_first : NULL;
			$pt->sick_district_first = ($request->sick_district_first != '0') ? $request->sick_district_first : NULL;
			$pt->sick_sub_district_first = ($request->sick_sub_district_first != '0') ? $request->sick_sub_district_first : NULL;
			$pt->health_coverage = ($request->health_coverage != '0') ? $request->health_coverage : NULL;
			$pt->treat_first_date = $this->convertDateToMySQL($request->treat_first_date);
			$pt->treat_first_province = ($request->treatFirstProvinceInput != '0') ? $request->treatFirstProvinceInput : NULL;
			$pt->treat_first_district = ($request->treatFirstDistrictInput != '0') ? $request->treatFirstDistrictInput : NULL;
			$pt->treat_first_sub_district = ($request->treatFirstSubDistrictInput != '0') ? $request->treatFirstSubDistrictInput : NULL;
			$pt->treat_first_hospital = ($request->treat_first_hospital != '0') ? $request->treat_first_hospital : NULL;

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

			/*
			if (Input::hasFile('labCxr1File')) {
				$lab_file1_new_name = 'cxr1_file_cid'.$request->id;
				$lab_file1_extension = Input::file('labCxr1File')->getClientOriginalExtension();
				$fileName1 = $lab_file1_new_name.'.'.$lab_file1_extension;
				$pt->lab_cxr1_file = $fileName1;
				Storage::disk('invest')->put($fileName1, File::get(Input::file('labCxr1File')));
			}
			*/

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
			$pt->lab_sars_cov2_no_1_specimen = ($request->lab_sars_cov2_no_1_specimen != '0') ? $request->lab_sars_cov2_no_1_specimen : NULL;
			$pt->lab_sars_cov2_no_1_lab = ($request->lab_sars_cov2_no_1_lab != '0') ? $request->lab_sars_cov2_no_1_lab : NULL;
			$pt->lab_sars_cov2_no_1_result = ($request->lab_sars_cov2_no_1_result != '0') ? $request->lab_sars_cov2_no_1_result : NULL;
			$pt->lab_sars_cov2_no_2 = 2;
			$pt->lab_sars_cov2_no_2_date = $this->convertDateToMySQL($request->lab_sars_cov2_no_2_date);
			$pt->lab_sars_cov2_no_2_specimen = ($request->lab_sars_cov2_no_2_specimen != '0') ? $request->lab_sars_cov2_no_2_specimen : NULL;
			$pt->lab_sars_cov2_no_2_lab = ($request->lab_sars_cov2_no_2_lab != '0') ? $request->lab_sars_cov2_no_2_lab : NULL;
			$pt->lab_sars_cov2_no_2_result = ($request->lab_sars_cov2_no_2_result != '0') ? $request->lab_sars_cov2_no_2_result : NULL;
			$pt->treat_patient_type = $request->treat_patient_type;
			$pt->treat_place_date = $this->convertDateToMySQL($request->treat_place_date);
			$pt->first_diag = $request->firstDiagInput;
			$pt->covid19_drug_medicate = $request->covid19Drugchk;
			$pt->covid19_drug_medicate_first_date = $this->convertDateToMySQL($request->covid19_drug_medicate_first_date);

			/* set drug name to array */
			$drugStr = NULL;
			if (!is_null($request->covid19_drug_medicate_name) && !empty($request->covid19_drug_medicate_name)) {
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

			/* set cur patient treat statau to var */
			$cur_patient_treat_status = $pt->patient_treat_status;
			$pt->patient_treat_status = $request->patientTreatStatus;

			/* log refer && set treatplace match this */
			if ($request->patientTreatStatus == '4' && !empty($request->patient_treat_status_refer_province) && !empty($request->patient_treat_status_refer_district) && !empty($request->patient_treat_status_refer)) {
				/* check repeat log data */
				$today_now = date('Y-m-d H:i:s');
				$repeat_log = DB::table('log_refer')
					->where('ref_pt_id', '=', $request->id)
					->where('refer_hosp', '=', $request->patient_treat_status_refer)
					->limit(1)
					->get();
				if (count($repeat_log) <= 0) {
					DB::table('log_refer')->insert([
						'ref_pt_id' => $request->id,
						'cur_status' => $cur_patient_treat_status,
						'ch_status' => 4,
						'cur_hosp' => $pt->treat_place_hospital,
						'refer_hosp' => $request->patient_treat_status_refer,
						'refer_date' => $this->convertDateToMySQL($request->patient_treat_status_refer_date),
						'ref_user_id' => Auth::user()->id,
						'created_at' => $today_now
					]);
					$pt->treat_place_province = ($request->patient_treat_status_refer_province != '0') ? $request->patient_treat_status_refer_province : NULL;
					$pt->treat_place_district = ($request->patient_treat_status_refer_district != '0') ? $request->patient_treat_status_refer_district : NULL;
					$pt->treat_place_sub_district = ($request->patient_treat_status_refer_sub_district != '0') ? $request->patient_treat_status_refer_sub_district : NULL;
					$pt->treat_place_hospital = ($request->patient_treat_status_refer != '0') ? $request->patient_treat_status_refer : NULL;
				}
			} else {
				$pt->treat_place_province = ($request->treatPlaceProvinceInput != '0') ? $request->treatPlaceProvinceInput : NULL;
				$pt->treat_place_district = ($request->treatPlaceDistrictInput != '0') ? $request->treatPlaceDistrictInput : NULL;
				$pt->treat_place_sub_district = ($request->treatPlaceSubDistrictInput != '0') ? $request->treatPlaceSubDistrictInput : NULL;
				$pt->treat_place_hospital = ($request->treat_place_hospital != '0') ? $request->treat_place_hospital : NULL;
			}

			$pt->patient_treat_status_other = $request->patient_treat_status_other;
			$pt->patient_treat_status_refer = ($request->patient_treat_status_refer != '0') ? $request->patient_treat_status_refer : NULL;
			$pt->patient_treat_status_refer_province = ($request->patient_treat_status_refer_province != '0') ? $request->patient_treat_status_refer_province : NULL;
			$pt->patient_treat_status_refer_district = ($request->patient_treat_status_refer_district != '0') ? $request->patient_treat_status_refer_district : NULL;
			$pt->patient_treat_status_refer_sub_district = ($request->patient_treat_status_refer_sub_district != '0') ? $request->patient_treat_status_refer_sub_district : NULL;
			$pt->patient_treat_status_refer_date = $this->convertDateToMySQL($request->patient_treat_status_refer_date);
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
			$pt->risk_stay_outbreak_country = ($request->riskStayOutbreakCountryInput != '0') ? $request->riskStayOutbreakCountryInput : NULL;
			$pt->risk_stay_outbreak_city = ($request->riskStayOutbreakCityInput != '0') ? $request->riskStayOutbreakCityInput : NULL;
			$pt->risk_stay_outbreak_city_other = $request->riskStayOutbreakCityOtherInput;
			$pt->risk_stay_outbreak_arrive_date = $this->convertDateToMySQL($request->riskStayOutbreakArriveDate);
			$pt->risk_stay_outbreak_arrive_thai_date = $this->convertDateToMySQL($request->riskStayOutbreakArriveThaiDate);
			$pt->risk_stay_outbreak_airline = $request->riskStayOutbreakAirline;
			$pt->risk_stay_outbreak_flight_no = $request->riskStayOutbreakFlightNoInput;
			$pt->risk_stay_outbreak_seat_no = $request->riskStayOutbreakSeatNoInput;
			$pt->risk_stay_outbreak_province = ($request->riskStayOutbreakProvinceInput != '0') ? $request->riskStayOutbreakProvinceInput : NULL;
			$pt->risk_stay_outbreak_district = ($request->riskStayOutbreakDistrictInput != '0') ? $request->riskStayOutbreakDistrictInput : NULL;
			$pt->risk_stay_outbreak_sub_district = ($request->riskStayOutbreakSubDistrictInput != '0') ? $request->riskStayOutbreakSubDistrictInput : NULL;
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
			$pt->risk_type = ($request->risk_type != '0') ? $request->risk_type : NULL;
			$pt->risk_type_text = $request->risk_type_text;
			$pt->entry_user_last_update = auth()->user()->id;
			$pt->invest_note = $request->invest_note;

			/*
			if (Input::hasFile('invest_file')) {
				$inv_file_new_name = 'inv_file_cid'.$request->id;
				$inv_file_extension = Input::file('invest_file')->getClientOriginalExtension();
				$inv_file_name = $inv_file_new_name.'.'.$inv_file_extension;
				$pt->invest_file = $inv_file_name;
				Storage::disk('invest')->put($inv_file_name, File::get(Input::file('invest_file')));
			}
			*/

			/* save activity */
			for ($i=1; $i<=10; $i++) {
				$activityDate = $request->input('activityDate'.$i);
				if (!empty($activityDate) || !is_null($activityDate)) {
					$p2['ref_patient_id'] = $request->id;
					$p2['day'] = $request->input('acc_day'.$i);
					$p2['date_activity'] = $this->convertDateToMySQL($activityDate);
					$p2['activity'] = $request->input('activity'.$i);
					$p2['place'] = $request->input('activityPlace'.$i);
					$p2['personal_amount'] = $request->input('activityAmount'.$i);
					$p2['personal_name'] = $request->input('activityName'.$i);
					$p1['day'] = $request->input('acc_day'.$i);
					$p1['ref_patient_id'] = $request->id;
					$act_saved = PatientActivity::updateOrCreate($p1, $p2);
				} else {
					continue;
				}
			}
			$pt_saved = $pt->save();
			if ($pt_saved) {
				return redirect()->back()->with('success', 'บันทึกข้อมูลสำเร็จแล้ว');
			}
		} catch(\Exception $e) {
			Log::error(sprintf("%s - line %d - ", __FILE__, __LINE__).$e->getMessage());
		}
	}

	public function storeReferOut(Request $request) {
		try {
			if (!empty($request->refer_province) && !empty($request->refer_district) && !empty($request->refer_hospital)) {
				$today_now = date('Y-m-d H:i:s');
				$today_date = date('Y-m-d');
				$pt = Invest::find($request->refer_pid);

				/* set current data */
				$cur_patient_treat_status = $pt->patient_treat_status;
				$cur_prov = $pt->treat_place_province;
				$cur_dist = $pt->treat_place_district;
				$cur_sub_dist = $pt->treat_place_sub_district;
				$cur_hosp = $pt->treat_place_hospital;

				/* update to new data */
				$pt->treat_place_province = $request->refer_province;
				$pt->treat_place_district = $request->refer_district;
				$pt->treat_place_sub_district = $request->refer_sub_district;
				$pt->treat_place_hospital = $request->refer_hospital;

				$pt->patient_treat_status = 4;
				$pt->patient_treat_status_refer = $request->refer_hospital;
				$pt->patient_treat_status_refer_province = $request->refer_province;
				$pt->patient_treat_status_refer_district = $request->refer_district;
				$pt->patient_treat_status_refer_sub_district = $request->refer_sub_district;
				$pt->patient_treat_status_refer_date = $today_now;

				$pt_saved = $pt->save();

				if ($pt_saved) {
					DB::table('log_refer')->insert([
						'ref_pt_id' => $request->refer_pid,
						'cur_status' => $cur_patient_treat_status,
						'ch_status' => 4,
						'cur_hosp' => $cur_hosp,
						'refer_hosp' => $request->refer_hospital,
						'refer_date' => $today_date,
						'ref_user_id' => Auth::user()->id,
						'created_at' => $today_now
					]);
					Log::notice('User: '.Auth::user()->id.' Refer PID:'.$request->refer_pid);
					return redirect()->back()->with('success', 'ข้อมูลรหัสที่ '.$request->refer_pid.' บันทึกลงฐานข้อมูลสำเร็จแล้ว');
				}
			} else {
				return redirect()->back()->with('error', 'บันทึกไม่สำเร็จ!! ข้อมูลไม่ครบหรือไม่ถูกต้อง โปรดตรวจสอบ?');
			}
		} catch(\Exception $e) {
			Log::error(sprintf("%s - line %d - ", __FILE__, __LINE__).$e->getMessage());
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
		$htm = "<option value=\"0\">-- โปรดเลือก --</option>";
		if (count($coll) > 0) {
			$hospitals = $coll->keyBy('hospcode');
			foreach ($hospitals as $key => $val) {
				$htm .= "<option value=\"".$val->hospcode."\">".$val->hosp_name."</option>";
			}
		}
		return $htm;
	}

	public function hospitalByDistrictCode2Digit($prov_code=0, $dist_code=0) {
		return DB::connection('mysql')
			->table('chospital_new')
			->select('hospcode', 'hosp_name')
			->where('prov_code', '=', $prov_code)
			->where('ampur_code', '=', $dist_code)
			->where('status_code', '=', '1')
			//->orderBy('hosp_name', 'asc')
			->get();
	}

	public function hospitalFetchByDistrict2Digit(Request $request) {
		$dist_id_2_digit = substr($request->dist_id, -2);

		if (strlen($dist_id_2_digit) <= 1) {
			$dist_id_2_digit = '0'.$dist_id_2_digit;
		}

		$coll = $this->hospitalByDistrictCode2Digit($request->prov_id, $dist_id_2_digit);
		$htm = "<option value=\"0\">-- โปรดเลือก --</option>";
		if (count($coll) > 0) {
			$hospitals = $coll->keyBy('hospcode');
			foreach ($hospitals as $key => $val) {
				$htm .= "<option value=\"".$val->hospcode."\">".$val->hosp_name."</option>";
			}
		}
		return $htm;
	}

	protected function getHospitalNameTh($hosp_code='0') {
		if (!empty($hosp_code) && $hosp_code != '0' && !is_null($hosp_code)) {
			$hosp_name = Hospitals::select('hosp_name')
				->where('hospcode', '=', $hosp_code)
				->get()
				->toArray();
		} else {
			$hosp_name = null;
		}
		return $hosp_name;
	}

	protected function getCityName($city_id='0') {
		if (!empty($city_id) && $city_id != '0' && !is_null($city_id)) {
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

	protected function getDistirctNameTh($dist_code='0') {
		if (!empty($dist_code) && $dist_code != '0' && !is_null($dist_code)) {
			$dist_name = District::select('district_name')
				->where('district_id', '=', $dist_code)
				->get()
				->toArray();
		} else {
			$dist_name = null;
		}
		return $dist_name;
	}

	protected function getSubDistirctNameTh($sub_dist_code='0') {
		if (!empty($sub_dist_code) && $sub_dist_code != '0' && !is_null($sub_dist_code)) {
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
		if (!is_null($date) && !empty($date)) {
			$ep = explode("/", $date);
			$string = $ep[2]."-".$ep[1]."-".$ep[0];
		} else {
			$string = NULL;
		}
		return $string;
	}

	protected function convertMySQLDateFormat($date='00-00-0000', $seperator="/") {
		if (!is_null($date) && !empty($date)) {
			$ep = explode("-", $date);
			$string = $ep[2].$seperator.$ep[1].$seperator.$ep[0];
		} else {
			$string = NULL;
		}
		return $string;
	}

	public function migrateFileUpload() {
		echo 'for pj only';
		exit;
		$files = Invest::select('id', 'sat_id', 'entry_user', 'lab_cxr1_file', 'invest_file', 'created_at')
			->whereNotNull('lab_cxr1_file')
			->orWhereNotNull('invest_file')
			->get()
			->toArray();
		foreach ($files as $key => $value) {
			if (!is_null($value['lab_cxr1_file']) && !empty($value['lab_cxr1_file'])) {
				if (Storage::disk('invest')->exists($value['lab_cxr1_file'])) {
					$cxr_size = Storage::disk('invest')->size($value['lab_cxr1_file']);
					$size = ($cxr_size/1024);
					$cxr_mime = Storage::disk('invest')->mimeType($value['lab_cxr1_file']);
				} else {
					$size = null;
					$cxr_mime = null;
				}

				$f = new FilesUpload;
				$f->ref_user_id = $value['entry_user'];
				$f->ref_pt_id = $value['id'];
				$f->ref_pt_sat_id = $value['sat_id'];
				$f->file_name = $value['lab_cxr1_file'];
				$f->file_mime = $cxr_mime;
				$f->file_path = '/invest';
				$f->file_size = $size;
				$f->file_upload_type = 'x-ray';
				$f->created_at = $value['created_at'];
				$f->save();
			}

			if (!is_null($value['invest_file']) && !empty($value['invest_file'])) {
				if (Storage::disk('invest')->exists($value['invest_file'])) {
					$inv_size = Storage::disk('invest')->size($value['invest_file']);
					$size = ($inv_size/1024);
					$inv_mime = Storage::disk('invest')->mimeType($value['invest_file']);
				} else {
					$size = null;
					$inv_mime = null;
				}

				$f1 = new FilesUpload;
				$f1->ref_user_id = $value['entry_user'];
				$f1->ref_pt_id = $value['id'];
				$f1->ref_pt_sat_id = $value['sat_id'];
				$f1->file_name = $value['invest_file'];
				$f1->file_mime = $inv_mime;
				$f1->file_path = '/invest';
				$f1->file_size = $size;
				$f1->file_upload_type = 'invest';
				$f1->created_at = $value['created_at'];
				$f1->save();
			}
		}
		echo 'Done';
	}
}

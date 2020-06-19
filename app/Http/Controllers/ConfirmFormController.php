<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Storage;
use App\TitleName;
use App\Provinces;
use App\InvestList;
use App\Occupation;
use App\District;
use App\SubDistrict;
use App\GlobalCity;
use App\GlobalCountry;
use Log;
use Session;

class ConfirmFormController extends Controller
{
	public function __construct() {
		$this->middleware('auth');
		$this->middleware('onlyOneUser');
		//$this->middleware(['role:admin']);
	}

	public function changeStatus(Request $request) {
		$pt = InvestList::find($request->id);
		$pt->pt_status = $request->pt_status;
		$pt->news_st = $request->news_status;
		$pt->disch_st = $request->disch_st;
		$pt->updated_at = date('Y-m-d H:i:s');
		$pt_saved = $pt->save();
		if ($pt_saved) {
			return redirect()->route('investList.index');
			exit;
		}
	}

	public function changeStatusSeverSide(Request $request) {
		try {
			$pt = InvestList::find($request->id);

			/* set current status to variable after change */
			$cur_pt_status = $pt->pt_status;
			$cur_news_st = $pt->news_st;
			$cur_disch_st = $pt->disch_st;

			/* prepare change to new status */
			$user_role = Session::get('user_role');
			switch ($user_role) {
				case 'root':
					/* pt status */
					$pt->pt_status = $request->pt_status;
					$ch_pt_status = $request->pt_status;
					/* new st status */
					$pt->news_st = $request->news_status;
					$ch_news_st = $request->news_status;
					/* discharge status */
					$pt->disch_st = $request->disch_st;
					break;
				case 'ddc':
					/* pt status */
					if ($cur_pt_status == 2) {
						$pt->pt_status = $cur_pt_status;
						$ch_pt_status = $cur_pt_status;
					} else {
						$pt->pt_status = $request->pt_status;
						$ch_pt_status = $request->pt_status;
					}

					/* new st status */
					$pt->news_st = $request->news_status;
					$ch_news_st = $request->news_status;

					/* discharge status */
					$pt->disch_st = $request->disch_st;
					break;
				default:
					/* pt status */
					if ($cur_pt_status == 2) {
						$pt->pt_status = $cur_pt_status;
						$ch_pt_status = $cur_pt_status;
					} else {
						$pt->pt_status = $request->pt_status;
						$ch_pt_status = $request->pt_status;
					}

					/* new st status */
					$pt->news_st = $pt->news_st;
					$ch_news_st = $pt->news_st;

					/* discharge status */
					$pt->disch_st = $request->disch_st;
					break;
			}

			$pt->updated_at = date('Y-m-d H:i:s');
			$pt_saved = $pt->save();

			/* log change status */
			if ($pt_saved) {
				DB::table('log_ch_status')->insert([
					'ref_pt_id' => $request->id,
					'cur_pt_status' => $cur_pt_status,
					'ch_pt_status' => $ch_pt_status,
					'cur_news_st' => $cur_news_st,
					'ch_news_st' => $ch_news_st,
					'cur_disch_st' => $cur_disch_st,
					'ch_disch_st' => $request->disch_st,
					'ch_date' => date('Y-m-d H:i:s'),
					'ref_user_id' => auth()->user()->id
				]);
				return redirect()->back()->with('success', 'เปลี่ยนสถานะข้อมูลสำเร็จแล้ว');
			}
		} catch(\Exception $e) {
			Log::error($e->getMessage());
			return redirect()->back()->with('error', 'ไม่สามารถเปลี่ยนสถานะข้อมูล โปรดตรวจสอบ');
		}
	}

	public function changePtStatus(Request $request) {
		try {
			$pt = InvestList::find($request->id);
			$cur_pt_status = $pt->pt_status;

			$user_role = Session::get('user_role');
			switch ($user_role) {
				case 'root':
					$pt->pt_status = $request->pt_status;
					$ch_pt_status = $request->pt_status;
					break;
				case 'ddc':
					if ($cur_pt_status == 2) {
						$pt->pt_status = $cur_pt_status;
						$ch_pt_status = $cur_pt_status;
					} else {
						$pt->pt_status = $request->pt_status;
						$ch_pt_status = $request->pt_status;
					}
					break;
				default:
					if ($cur_pt_status == 2) {
						$pt->pt_status = $cur_pt_status;
						$ch_pt_status = $cur_pt_status;
					} else {
						$pt->pt_status = $request->pt_status;
						$ch_pt_status = $request->pt_status;
					}
					break;
			}

			if (is_null($request->pt_type) || empty($request->pt_type) || $request->pt_type == '0') {
				$pt->type_nature = null;
			} else {
				$pt->type_nature = $request->pt_type;
			}

			$pt->updated_at = date('Y-m-d H:i:s');
			$pt_saved = $pt->save();

			/* log change status */
			if ($pt_saved) {
				DB::table('log_ch_status')->insert([
					'ref_pt_id' => $request->id,
					'cur_pt_status' => $cur_pt_status,
					'ch_pt_status' => $ch_pt_status,
					'ch_date' => date('Y-m-d H:i:s'),
					'ref_user_id' => auth()->user()->id
				]);
				Log::notice('User: '.auth()->user()->id.' Change patient status '.$cur_pt_status.' to '.$ch_pt_status);
				return redirect()->back()->with('success', 'ข้อมูลรหัส: '.$request->id.' ถูกเปลี่ยนสถานะผู้ป่วยแล้ว');
			}
		} catch(\Exception $e) {
			Log::error($e->getMessage());
			return redirect()->back()->with('error', 'ไม่สามารถเปลี่ยนสถานะข้อมูล โปรดตรวจสอบ');
		}
	}

	public function changeNewsStatus(Request $request) {
		try {
			$pt = InvestList::find($request->id);
			$cur_news_st = $pt->news_st;

			$user_role = Session::get('user_role');
			switch ($user_role) {
				case 'root':
					$pt->news_st = $request->news_status;
					$ch_news_st = $request->news_status;
					break;
				case 'ddc':
					$pt->news_st = $request->news_status;
					$ch_news_st = $request->news_status;
					break;
				default:
					return redirect()->back()->with('error', 'ไม่มีสิทธิ์เปลี่ยนสถานะข้อมูล โปรดติดต่อผู้ดูแลระบบ');
					break;
			}

			if (!isset($request->orderNo) || empty($request->orderNo) || is_null($request->orderNo) || $request->orderNo <= 0) {
				$pt->order_pt = null;
			} else {
				$pt->order_pt = $request->orderNo;
			}

			if (!isset($request->orderDate) || empty($request->orderDate) || is_null($request->orderDate) || $request->orderDate <= 0) {
				$pt->news_dt = null;
			} else {
				$pt->news_dt = self::convertDateToMySQL($request->orderDate);
			}

			$pt->updated_at = date('Y-m-d H:i:s');
			$pt_saved = $pt->save();

			if ($pt_saved) {
				DB::table('log_ch_status')->insert([
					'ref_pt_id' => $request->id,
					'cur_news_st' => $cur_news_st,
					'ch_news_st' => $ch_news_st,
					'ch_date' => date('Y-m-d H:i:s'),
					'ref_user_id' => auth()->user()->id
				]);
				Log::notice('User: '.auth()->user()->id.' Change News status '.$cur_news_st.' to '.$ch_news_st);
				return redirect()->back()->with('success', 'ข้อมูลรหัส: '.$request->id.' ถูกเปลี่ยนสถานะการแถลงข่าวแล้ว');
			}
		} catch(\Exception $e) {
			Log::error($e->getMessage());
			return redirect()->back()->with('error', 'ไม่สามารถเปลี่ยนสถานะข้อมูล โปรดตรวจสอบ');
		}
	}

	public function changeDcStatus(Request $request) {
		try {
			$pt = InvestList::find($request->id);
			$cur_disch_st = $pt->disch_st;
			$pt->disch_st = $request->disch_st;
			$pt->updated_at = date('Y-m-d H:i:s');
			$pt_saved = $pt->save();
			if ($pt_saved) {
				DB::table('log_ch_status')->insert([
					'ref_pt_id' => $request->id,
					'cur_disch_st' => $cur_disch_st,
					'ch_disch_st' => $request->disch_st,
					'ch_date' => date('Y-m-d H:i:s'),
					'ref_user_id' => auth()->user()->id
				]);
				Log::notice('User: '.auth()->user()->id.' Change Discharge status '.$cur_disch_st.' to '.$request->disch_st);
				return redirect()->back()->with('success', 'ข้อมูลรหัส: '.$request->id.' ถูกเปลี่ยนสถานะ Discharge แล้ว');
			}
		} catch(\Exception $e) {
			Log::error($e->getMessage());
			return redirect()->back()->with('error', 'ไม่สามารถเปลี่ยนสถานะข้อมูล โปรดตรวจสอบ');
		}
	}



	public function create(Request $request) {
		$titleName = TitleName::all()->keyBy('id')->toArray();
		$provinces = Provinces::all()->sortBy('province_name')->keyBy('province_id')->toArray();
		$occupation = Occupation::all()->keyBy('id')->toArray();
		$globalCountry = GlobalCountry::all()->keyBy('country_id')->toArray();
		//$globalCountry = $globalCountry->keyBy('country_id')->toArray();
		$invest_pt = InvestList::where('id', '=', $request->id)->get()->toArray();
		$work_city = GlobalCity::where('city_id', '=', $invest_pt[0]['work_city'])->get()->toArray();
		$cur_city = GlobalCity::where('city_id', '=', $invest_pt[0]['cur_city'])->get()->toArray();
		$sick_city = GlobalCity::where('city_id', '=', $invest_pt[0]['sick_city'])->get()->toArray();
		$risk_stay_outbreak_city = GlobalCity::where('city_id', '=', $invest_pt[0]['risk_stay_outbreak_city'])->get()->toArray();
		$treat_first_city = GlobalCity::where('city_id', '=', $invest_pt[0]['treat_first_city'])->get()->toArray();
		$treat_place_city = GlobalCity::where('city_id', '=', $invest_pt[0]['treat_place_city'])->get()->toArray();

		$data['flu_vaccine_chk_date'] = self::convertMySQLDateFormat($invest_pt[0]['flu_vaccine_chk_date']);
		$data['breathing_tube_date'] = self::convertMySQLDateFormat($invest_pt[0]['breathing_tube_date']);
		$data['antivirus_1_start_date'] = self::convertMySQLDateFormat($invest_pt[0]['antivirus_1_start_date']);
		$data['antivirus_1_end_date'] = self::convertMySQLDateFormat($invest_pt[0]['antivirus_1_end_date']);
		$data['antivirus_2_start_date'] = self::convertMySQLDateFormat($invest_pt[0]['antivirus_2_start_date']);
		$data['antivirus_2_end_date'] = self::convertMySQLDateFormat($invest_pt[0]['antivirus_2_end_date']);
		$data['antivirus_3_start_date'] = self::convertMySQLDateFormat($invest_pt[0]['antivirus_3_start_date']);
		$data['antivirus_3_end_date'] = self::convertMySQLDateFormat($invest_pt[0]['antivirus_3_end_date']);
		$data['antivirus_4_start_date'] = self::convertMySQLDateFormat($invest_pt[0]['antivirus_4_start_date']);
		$data['antivirus_4_end_date'] = self::convertMySQLDateFormat($invest_pt[0]['antivirus_4_end_date']);

		$data['risk_stay_outbreak_arrive_date'] = self::convertMySQLDateFormat($invest_pt[0]['risk_stay_outbreak_arrive_date']);
		$data['risk_stay_outbreak_arrive_thai_date'] = self::convertMySQLDateFormat($invest_pt[0]['risk_stay_outbreak_arrive_thai_date']);
		$data['risk_treat_or_visit_patient_hospital_date'] = self::convertMySQLDateFormat($invest_pt[0]['risk_treat_or_visit_patient_hospital_date']);
		$data['lab_cbc_date'] = self::convertMySQLDateFormat($invest_pt[0]['lab_cbc_date']);
		$data['lab_chemistry_date'] = self::convertMySQLDateFormat($invest_pt[0]['lab_chemistry_date']);
		$data['lab_liver_function_test_date'] = self::convertMySQLDateFormat($invest_pt[0]['lab_liver_function_test_date']);
		$data['lab_sputum_afb_date'] = self::convertMySQLDateFormat($invest_pt[0]['lab_sputum_afb_date']);
		$data['lab_sputum_culture_date'] = self::convertMySQLDateFormat($invest_pt[0]['lab_sputum_culture_date']);
		$data['lab_hemoculture_date'] = self::convertMySQLDateFormat($invest_pt[0]['lab_hemoculture_date']);
		$data['lab_cxr1_date'] = self::convertMySQLDateFormat($invest_pt[0]['lab_cxr1_date']);
		$data['lab_cxr2_date'] = self::convertMySQLDateFormat($invest_pt[0]['lab_cxr2_date']);
		$data['lab_rapid_test_date'] = self::convertMySQLDateFormat($invest_pt[0]['lab_rapid_test_date']);
		$data['lab_other_date'] = self::convertMySQLDateFormat($invest_pt[0]['lab_other_date']);
		$data['data3_1date_sickdate'] = self::convertMySQLDateFormat($invest_pt[0]['data3_1date_sickdate']);
		$data['treat_first_date'] = self::convertMySQLDateFormat($invest_pt[0]['treat_first_date']);
		$data['treat_place_date'] = self::convertMySQLDateFormat($invest_pt[0]['treat_place_date']);
		/* work district */
		if (!empty($invest_pt[0]['work_district'])) {
			$work_district = District::where('district_id', '=', $invest_pt[0]['work_district'])->get()->toArray();
		} else {
			$work_district = null;
		}
		/* work sub district */
		if (!empty($invest_pt[0]['work_sub_district'])) {
			$work_sub_district = SubDistrict::where('sub_district_id', '=', $invest_pt[0]['work_sub_district'])->get()->toArray();
		} else {
			$work_sub_district = null;
		}

		/* current district */
		if (!empty($invest_pt[0]['cur_district'])) {
			$cur_district = District::where('district_id', '=', $invest_pt[0]['cur_district'])->get()->toArray();
		} else {
			$cur_district = null;
		}

		/* sub district */
		if (!empty($invest_pt[0]['cur_sub_district'])) {
			$cur_sub_district = SubDistrict::where('sub_district_id', '=', $invest_pt[0]['cur_sub_district'])->get()->toArray();
		} else {
			$cur_sub_district = null;
		}

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

		return view('form.confirm.index',
			[
				'globalCountry' => $globalCountry,
				'invest_pt' => $invest_pt,
				'work_city' => $work_city,
				'cur_city' => $cur_city,
				'sick_city' => $sick_city,
				'risk_stay_outbreak_city' => $risk_stay_outbreak_city,
				'treat_first_city' => $treat_first_city,
				'treat_place_city' => $treat_place_city,
				'data' => $data,
				'titleName' => $titleName,
				'provinces' => $provinces,
				'occupation' => $occupation,
				'work_district' => $work_district,
				'work_sub_district' => $work_sub_district,
				'cur_district' => $cur_district,
				'cur_sub_district' => $cur_sub_district,
				'sick_district' => $sick_district,
				'sick_sub_district' => $sick_sub_district,
				'risk_district' => $risk_district,
				'risk_sub_district' => $risk_sub_district,
				'treat_first_district' => $treat_first_district,
				'treat_first_sub_district' => $treat_first_sub_district,
				'treat_place_district' => $treat_place_district,
				'treat_place_sub_district' => $treat_place_sub_district

			]
		);
	}

	public function addConfirmCase(Request $request)
	{
		$pt = InvestList::find($request->id);
		/* section 1 */
		$pt->title_name = $request->titleName;
		$pt->first_name = $request->firstNameInput;
		$pt->mid_name = $request->midNameInput;
		$pt->last_name = $request->lastNameInput;
		$pt->sex = $request->sexInput;
		$pt->age = $request->ageYearInput;
		$pt->age_month = $request->ageMonthInput;
		$pt->age_days = $request->ageDayInput;
		$pt->nation = $request->nationalityInput;
		$pt->race = $request->raceInput;
		$pt->occupation = $request->occupationInput;
		$pt->occupation_oth = $request->occupationOthInput;
		$pt->work_contact = $request->workContactInput;
		$pt->work_office = $request->workOfficeInput;
		$pt->work_phone = $request->workPhoneInput;
		$pt->work_country = $request->workCountryInput;
		$pt->work_city = $request->workCityInput;
		$pt->work_city_other = $request->workCityOtherInput;
		$pt->work_province = $request->workProvinceInput;
		$pt->work_district = $request->workDistrictInput;
		$pt->work_sub_district = $request->workSubDistrictInput;
		$pt->cur_house_no = $request->curHouseNoInput;
		$pt->cur_village_no = $request->curVillageNoInput;
		$pt->cur_village = $request->curVillageInput;
		$pt->cur_lane = $request->curLaneInput;
		$pt->cur_road = $request->curRoadInput;
		$pt->cur_country = $request->curCountryInput;
		$pt->cur_city = $request->curCityInput;
		$pt->cur_city_other = $request->curCityOtherInput;
		$pt->cur_province = $request->curProvinceInput;
		$pt->cur_district = $request->curDistrictInput;
		$pt->cur_sub_district = $request->curSubDistrictInput;
		$pt->cur_phone = $request->curPhoneInput;
		$pt->sick_house_no = $request->sickHouseNoInput;
		$pt->sick_village_no = $request->sickVillageNoInput;
		$pt->sick_village = $request->sickVillageInput;
		$pt->sick_lane = $request->sickLaneInput;
		$pt->sick_road = $request->sickRoadInput;
		$pt->sick_country = $request->sickCountryInput;
		$pt->sick_city = $request->sickCityInput;
		$pt->sick_city_other = $request->sickCityOtherInput;
		$pt->sick_province = $request->sickProvinceInput;
		$pt->sick_district = $request->sickDistrictInput;
		$pt->sick_sub_district = $request->sickSubDistrictInput;
		$pt->sick_phone = $request->sickTelePhoneInput;

		/* section 2 */
		$pt->flu_vaccine_chk = $request->fluVaccineChk;
		$pt->flu_vaccine_chk_date = $this->convertDateToMySQL($request->flu_vaccine_chk_date);
		$pt->breathing_tube_chk = $request->breathingTubeChk;
		$pt->breathing_tube_date = $this->convertDateToMySQL($request->breathing_tube_date);
		$pt->complication_chk = $request->complicationChk;
		$pt->complication_respiratory_failure = $request->complicationRespiratoryFailure;
		$pt->complication_septic_shock = $request->complicationSepticShock;
		$pt->complication_liver_failure = $request->complicationLiverFailure;
		$pt->complication_kidney_failure = $request->complicationKidneyFailure;
		$pt->complication_encephalitis = $request->complicationEncephalitis;
		$pt->complication_myocarditis = $request->complicationMyocarditis;
		$pt->complication_other = $request->complicationOther;
		$pt->complication_other_detail = $request->complicationOtherDetail;
		$pt->antivirus_chk = $request->antiVirusChk;
		$pt->antivirus_1_name = $request->antivirus1Name;
		$pt->antivirus_1_dose = $request->antivirus1Dose;
		$pt->antivirus_1_start_date = $this->convertDateToMySQL($request->antivirus1StartDate);
		$pt->antivirus_1_end_date = $this->convertDateToMySQL($request->antivirus1EndDate);
		$pt->antivirus_2_name = $request->antivirus2Name;
		$pt->antivirus_2_dose = $request->antivirus2Dose;
		$pt->antivirus_2_start_date = $this->convertDateToMySQL($request->antivirus2StartDate);
		$pt->antivirus_2_end_date = $this->convertDateToMySQL($request->antivirus2EndDate);
		$pt->antivirus_3_name = $request->antivirus3Name;
		$pt->antivirus_3_dose = $request->antivirus3Dose;
		$pt->antivirus_3_start_date = $this->convertDateToMySQL($request->antivirus3StartDate);
		$pt->antivirus_3_end_date = $this->convertDateToMySQL($request->antivirus3EndDate);
		$pt->antivirus_4_name = $request->antivirus4Name;
		$pt->antivirus_4_dose = $request->antivirus4Dose;
		$pt->antivirus_4_start_date = $this->convertDateToMySQL($request->antivirus4StartDate);
		$pt->antivirus_4_end_date = $this->convertDateToMySQL($request->antivirus4EndDate);
		$pt->risk_stay_outbreak_chk = $request->riskStayOutbreakChk;
		$pt->risk_stay_outbreak_country = $request->riskStayOutbreakCountryInput;
		$pt->risk_stay_outbreak_city = $request->riskStayOutbreakCityInput;
		$pt->risk_stay_outbreak_city_other = $request->riskStayOutbreakCityOtherInput;
		$pt->risk_stay_outbreak_province = $request->riskStayOutbreakProvinceInput;
		$pt->risk_stay_outbreak_district = $request->riskStayOutbreakDistrictInput;
		$pt->risk_stay_outbreak_sub_district = $request->riskStayOutbreakSubDistrictInput;
		$pt->risk_stay_outbreak_arrive_date = $this->convertDateToMySQL($request->riskStayOutbreakArriveDate);
		$pt->risk_stay_outbreak_arrive_thai_date = $this->convertDateToMySQL($request->riskStayOutbreakArriveThaiDate);
		$pt->risk_stay_outbreak_airline = $request->riskStayOutbreakAirline;
		$pt->risk_stay_outbreak_flight_no = $request->riskStayOutbreakFlightNoInput;
		$pt->risk_stay_outbreak_seat_no = $request->riskStayOutbreakSeatNoInput;
		$pt->risk_history_human_contact = $request->riskHistoryHumanContact;
		$pt->risk_history_human_contact_detail = $request->riskHistoryHumanContactDetail;
		$pt->risk_history_human_contact_duration = $request->riskHistoryHumanContactDuration;
		$pt->risk_history_human_contact_symptom = $request->riskHistoryHumanContactSymptom;
		$pt->risk_history_human_contact_symptom_detail = $request->riskHistoryHumanContactSymptomDetail;
		$pt->risk_eat_cook_animal = $request->riskEatCookAnimal;
		$pt->risk_eat_cook_animal_type = $request->riskEatCookAnimalType;
		$pt->risk_contact_poultry = $request->riskContactPoultry;
		$pt->risk_contact_poultry_detail = $request->riskContactPoultryDetail;
		$pt->risk_poultry_dead = $request->riskPoultryDead;
		$pt->risk_poultry_market = $request->riskPoultryMarket;
		$pt->risk_poultry_market_name = $request->riskPoultryMarketName;
		$pt->risk_poultry_animal_name = $request->riskPoultryAnimalName;
		$pt->risk_poultry_market_ii = $request->riskPoultryMarketII;
		$pt->risk_poultry_market_name_ii = $request->riskPoultryMarketNameII;
		$pt->risk_poultry1_animal_name_ii = $request->riskPoultryAnimalNameII;
		$pt->risk_treat_or_visit_patient = $request->riskTreatOrVisitPatient;
		$pt->risk_treat_or_visit_patient_hospital_date = $this->convertDateToMySQL($request->riskTreatOrVisitPatientHospitalDate);
		$pt->risk_treat_or_visit_patient_hospital_name = $request->riskTreatOrVisitPatientHospitalName;
		$pt->risk_care_flu_patient = $request->riskCareFluPatient;
		$pt->risk_care_flu_patient_relation = $request->riskCareFluPatientRelation;
		$pt->risk_care_flu_patient_relation_name = $request->riskCareFluPatientRelationName;
		$pt->risk_patient_pneumonia_dead = $request->riskPatientPneumoniaDead;
		$pt->risk_closeup_flu_or_pneumonia = $request->riskCloseupFluOrPneumonia;

		/* section 3 */
		$pt->lab_cbc_date = $this->convertDateToMySQL($request->labCbcDate);
		$pt->lab_cbc_hb = $request->labCbcHb;
		$pt->lab_cbc_hct = $request->labCbcHct;
		$pt->lab_cbc_wbc = $request->labCbcWbc;
		$pt->lab_cbc_neutrophil = $request->labCbcNeutrophil;
		$pt->lab_cbc_lymphocyte = $request->labCbcLymphocyte;
		$pt->lab_cbc_platelet_count = $request->labCbcPlateletCount;
		$pt->lab_chemistry_date = $this->convertDateToMySQL($request->chemistryDateInput);
		$pt->lab_chemistry_bun = $request->labChemistryBun;
		$pt->lab_chemistry_cr = $request->labChemistryCr;
		$pt->lab_chemistry_gfr = $request->labChemistryGfr;
		$pt->lab_liver_function_test_date = $this->convertDateToMySQL($request->labLiverFunctionTestDate);
		$pt->lab_liver_function_test_sgot = $request->labLiverFunctionTestSgot;
		$pt->lab_liver_function_test_sgpt = $request->labLiverFunctionTestSgpt;
		$pt->lab_liver_function_test_alp = $request->labLiverFunctionTestAlp;
		$pt->lab_liver_function_test_total_bilirubin = $request->labLiverFunctionTestTotalBilirubin;
		$pt->lab_liver_function_test_direct_bilirubin = $request->labLiverFunctionTestDirectBilirubin;
		$pt->lab_liver_function_test_total_protein = $request->labLiverFunctionTestTotalProtein;
		$pt->lab_liver_function_test_albumin = $request->labLiverFunctionTestAlbumin;
		$pt->lab_liver_function_test_globulin = $request->labLiverFunctionTestGlobulin;
		$pt->lab_sputum_afb_date = $this->convertDateToMySQL($request->labSputumAfbDate);
		$pt->lab_sputum_afb_t = $request->labSputumAfbt;
		$pt->lab_sputum_culture_date = $this->convertDateToMySQL($request->labSputumCultureDate);
		$pt->lab_sputum_culture_result = $request->labSputumCultureResult;
		$pt->lab_sputum_culture_germ = $request->labSputumCultureGerm;
		$pt->lab_hemoculture_date = $this->convertDateToMySQL($request->labHemocultureDate);
		$pt->lab_hemoculture_result = $request->labHemocultureResult;
		$pt->lab_hemoculture_germ = $request->labHemocultureGerm;
		$pt->lab_cxr1_date = $this->convertDateToMySQL($request->labCxr1Date);
		$pt->lab_cxr1_result = $request->labCxr1Result;
		$pt->lab_cxr1_detail = $request->labCxr1Detail;

		/* lab :: file 1 */
		if (Input::hasFile('labCxr1File')) {
			$lab_file1_new_name = 'cxr1_file_cid'.$request->id;
			$lab_file1_extension = Input::file('labCxr1File')->getClientOriginalExtension();
			$fileName1 = $lab_file1_new_name.'.'.$lab_file1_extension;
			$pt->lab_cxr1_file = $fileName1;
			Storage::disk('invest')->put($fileName1, File::get(Input::file('labCxr1File')));
		}

		$pt->lab_cxr2_date = $this->convertDateToMySQL($request->labCxr2Date);
		$pt->lab_cxr2_result = $request->labCxr2Result;
		$pt->lab_cxr2_detail = $request->labCxr2Detail;

		/* lab :: file 2 */
		if (Input::hasFile('labCxr2File')) {
			$lab_file2_new_name = 'cxr2_file_cid'.$request->id;
			$lab_file2_extension = Input::file('labCxr2File')->getClientOriginalExtension();
			$fileName2 = $lab_file2_new_name.'.'.$lab_file2_extension;
			$pt->lab_cxr2_file = $fileName2;
			Storage::disk('invest')->put($fileName2, File::get(Input::file('labCxr2File')));
		}

		$pt->lab_rapid_test_date = $this->convertDateToMySQL($request->labRapidTestDate);
		/* $pt->lab_rapid_test_name = $request->labRapidTestName; */
		$pt->lab_rapid_test_result = $request->labRapidTestResult;
		$pt->lab_rapid_test_other = $request->labRapidTestOther;
		$pt->lab_other_name = $request->labOtherName;
		$pt->lab_other_specimen = $request->labOtherSpecimen;
		$pt->lab_other_date = $this->convertDateToMySQL($request->labOtherDate);
		$pt->lab_other_place = $request->labOtherPlace;
		$pt->lab_other_result = $request->labOtherResult;
		$pt->invest_note = $request->invest_note;

		$pt->fever_history = $request->fever_history;
		$pt->fever_current = $request->fever;
		$pt->data3_1date_sickdate = $this->convertDateToMySQL($request->data3_1date_sickdate);
		$pt->rr_rpm = $request->rr_rpm;
		$pt->sym_cough = $request->sym_cough;
		$pt->sym_snot = $request->sym_snot;
		$pt->sym_sore = $request->sym_sore;
		$pt->sym_dyspnea = $request->sym_dyspnea;
		$pt->sym_breathe = $request->sym_breathe;
		$pt->sym_stufefy = $request->sym_stufefy;
		$pt->treat_first_country = $request->treatFirstCountryInput;
		$pt->treat_first_city = $request->treatFirstCityInput;
		$pt->treat_first_city_other = $request->treatFirstCityOtherInput;
		$pt->treat_first_province = $request->treatFirstProvinceInput;
		$pt->treat_first_district = $request->treatFirstDistrictInput;
		$pt->treat_first_sub_district = $request->treatFirstSubDistrictInput;
		$pt->treat_first_date = $this->convertDateToMySQL($request->treat_first_date);
		$pt->treat_patient_type = $request->treat_patient_type;
		$pt->treat_place_country = $request->treatPlaceCountryInput;
		$pt->treat_place_city = $request->treatPlaceCityInput;
		$pt->treat_place_city_other = $request->treatPlaceCityOtherInput;
		$pt->treat_place_province = $request->treatPlaceProvinceInput;
		$pt->treat_place_district = $request->treatPlaceDistrictInput;
		$pt->treat_place_sub_district = $request->treatPlaceSubDistrictInput;
		$pt->treat_place_date = $this->convertDateToMySQL($request->treat_place_date);

		$pt->data3_3chk = $request->data3_3chk;
		$pt->data3_3chk_lung = $request->data3_3chk_lung;
		$pt->data3_3chk_heart = $request->data3_3chk_heart;
		$pt->data3_3chk_cirrhosis = $request->data3_3chk_cirrhosis;
		$pt->data3_3chk_kidney = $request->data3_3chk_kidney;
		$pt->data3_3chk_diabetes = $request->data3_3chk_diabetes;
		$pt->data3_3chk_blood = $request->data3_3chk_blood;
		$pt->data3_3chk_immune = $request->data3_3chk_immune;
		$pt->data3_3chk_anaemia = $request->data3_3chk_anaemia;
		$pt->data3_3chk_cerebral = $request->data3_3chk_cerebral;
		$pt->data3_3chk_pregnant = $request->data3_3chk_pregnant;
		$pt->data3_3chk_fat = $request->data3_3chk_fat;
		$pt->data3_3chk_cancer = $request->data3_3chk_cancer;
		$pt->data3_3chk_cancer_name = $request->data3_3chk_cancer_name;
		$pt->data3_3chk_other = $request->data3_3chk_other;
		$pt->data3_3chk_other = $request->data3_3chk_other;
		$pt->data3_3input_other = $request->data3_3input_other;

		$pt_saved = $pt->save();

		if ($pt_saved) {
			flash()->overlay('Successfully saved.', 'Covid-19');
			return redirect()->route('list-data.invest');
			exit;
		}
	}

	public function store(Request $request)
	{
		//
	}

	public function show($id)
	{
		//
	}

	public function edit($id)
	{
		//
	}

	public function update(Request $request, $id)
	{
	}

	public function destroy($id)
	{

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

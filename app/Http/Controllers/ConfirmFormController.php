<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TitleName;
use App\Provinces;
use App\InvestList;
use App\Occupation;
use App\District;
use App\SubDistrict;
use App\GlobalCity;
use App\GlobalCountry;
use DB;

class ConfirmFormController extends Controller
{

	public function index()
	{
		//
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

	public function create(Request $request)
	{
		$titleName = TitleName::all()->toArray();
		$provinces = Provinces::all()->sortBy('province_name')->keyBy('province_id')->toArray();
		$occupation = Occupation::all()->keyBy('id')->toArray();
		$globalCountry = GlobalCountry::all();
		$globalCountry = $globalCountry->keyBy('country_id')->toArray();
		$invest_pt = InvestList::where('id', '=', $request->id)->get()->toArray();
		$work_city = GlobalCity::where('city_id', '=', $invest_pt[0]['work_city'])->get()->toArray();
		$cur_city = GlobalCity::where('city_id', '=', $invest_pt[0]['cur_city'])->get()->toArray();
		$sick_city = GlobalCity::where('city_id', '=', $invest_pt[0]['sick_city'])->get()->toArray();

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

		return view('form.confirm.index',
			[
				'globalCountry' => $globalCountry,
				'invest_pt' => $invest_pt,
				'work_city' => $work_city,
				'cur_city' => $cur_city,
				'sick_city' => $sick_city,
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
				'risk_sub_district' => $risk_sub_district
			]
		);
	}

	public function addConfirmCase(Request $request)
	{
		$pt = InvestList::find($request->id);

		$pt->title_name = $request->titleName;
		$pt->first_name = $request->firstNameInput;
		$pt->mid_name = $request->midNameInput;
		$pt->last_name = $request->lastNameInput;
		$pt->sex = $request->sexInput;
		$pt->age = $request->ageYearInput;
		$pt->age_month = $request->ageMonthInput;
		$pt->nation = $request->nationalityInput;
		$pt->race = $request->raceInput;
		$pt->occupation = $request->occupationInput;
		$pt->occupation_oth = $request->occupationOthInput;
		$pt->work_contact = $request->workContactInput;
		$pt->work_office = $request->workOfficeInput;
		$pt->work_phone = $request->workPhoneInput;
		$pt->work_province = $request->provinceInput;
		$pt->work_district = $request->districtInput;
		$pt->work_sub_district = $request->subDistrictInput;
		$pt->sick_house_no = $request->houseNoInput;
		$pt->sick_village_no = $request->villageNoInput;
		$pt->sick_village = $request->villageInput;
		$pt->sick_lane = $request->laneInput;
		$pt->sick_road = $request->roadInput;
		$pt->sick_province = $request->patientProvinceInput;
		$pt->sick_district = $request->patientDistrictInput;
		$pt->sick_sub_district = $request->patientSubDistrictInput;
		$pt->phone = $request->telePhoneInput; /* vv */
		$pt->mobile = $request->mobilePhoneInput;
		$pt->informant_patient = $request->informantPatientInput;
		$pt->informant_relative = $request->informantRelativeInput;
		$pt->informant_relation = $request->relativeshipInput;
		$pt->informant_other = $request->informantOthChk;
		$pt->informant_other_text = $request->otherInformantInput;
		$pt->risk2_1chk = $request->risk2_1Chk;
		$pt->risk2_1input = $request->risk2_1Input;
		$pt->risk2_2chk = $request->risk2_2Chk;
		$pt->risk2_2date = $this->convertDateToMySQL($request->risk2_2Date);
		$pt->risk2_2animal = $request->risk2_2AnimalInput;
		$pt->risk2_3chk = $request->risk2_3Chk;
		$pt->risk2_4chk = $request->risk2_4Chk;
		$pt->risk2_4market_input = $request->risk2_4MarketInput;
		$pt->risk2_4animal_input = $request->risk2_4AnimalInput;
		$pt->risk2_5Chk = $request->risk2_5Chk;
		$pt->risk2_5market_input = $request->risk2_5MarketInput;
		$pt->risk2_5animal_input = $request->risk2_5AnimalInput;
		$pt->risk2_6chk = $request->risk2_6Chk;
		$pt->risk2_6input_country = $request->risk2_6CountryInput;
		$pt->risk2_6input_province = $request->risk2_6ProvinceInput;
		$pt->risk2_6input_district = $request->risk2_6DistrictInput;
		$pt->risk2_6date_arrive = $this->convertDateToMySQL($request->risk2_6DateArrive);
		$pt->risk2_6arrive_reason = $request->risk2_6ReasonInput;
		$pt->risk2_6workchk = $request->risk2_6WorkChk;
		$pt->risk2_6work_type = $request->risk2_6WorkTypeInput;
		$pt->risk2_6work_place = $request->risk2_6WorkPlaceInput;
		$pt->risk2_6work_duration = $request->risk2_6WorkDurationInput;
		$pt->risk2_6meeting_chk = $request->risk2_6MeetingChk;
		$pt->risk2_6meeting_place = $request->risk2_6MeetingPlaceInput;
		$pt->risk2_6meeting_date = self::convertDateToMySQL($request->risk2_6MeetingDate);
		$pt->risk2_6study_chk = $request->risk2_6StudyChk;
		$pt->risk2_6study_name = $request->risk2_6StudyNameInput;
		$pt->risk2_6study_duration = $request->risk2_6StudyDurationInput;
		$pt->risk2_6visit_chk = $request->risk2_6VisitChk;
		$pt->risk2_6visit_house_no = $request->risk2_6VisitHouseNoInput;
		$pt->risk2_6visit_duration = $request->risk2_6VisitDurationInput;
		$pt->risk2_6travel_chk = $request->risk2_6TravelChk;

		$pt->risk2_6travel_acc1_input = $request->risk2_6Activity1Input;
		$pt->risk2_6travel_acc1_place = $request->risk2_6Activity1PlaceInput;
		$pt->risk2_6travel_acc1_date = $this->convertDateToMySQL($request->risk2_6Activity1DateInput);

		$pt->risk2_6travel_acc2_input = $request->risk2_6Activity2Input;
		$pt->risk2_6travel_acc2_place = $request->risk2_6Activity2PlaceInput;
		$pt->risk2_6travel_acc2_date = $this->convertDateToMySQL($request->risk2_6Activity2DateInput);

		$pt->risk2_6travel_acc3_input = $request->risk2_6Activity3Input;
		$pt->risk2_6travel_acc3_place = $request->risk2_6Activity3PlaceInput;
		$pt->risk2_6travel_acc3_date = $this->convertDateToMySQL($request->risk2_6Activity3DateInput);

		$pt->risk2_6travel_acc4_input = $request->risk2_6Activity4Input;
		$pt->risk2_6travel_acc4_place = $request->risk2_6Activity4PlaceInput;
		$pt->risk2_6travel_acc4_date = $this->convertDateToMySQL($request->risk2_6Activity4DateInput);

		$pt->risk2_6travel_acc5_input = $request->risk2_6Activity5Input;
		$pt->risk2_6travel_acc5_place = $request->risk2_6Activity5PlaceInput;
		$pt->risk2_6travel_acc5_date = $this->convertDateToMySQL($request->risk2_6Activity5DateInput);

		$pt->risk2_6other_chk = $request->risk2_6TravelOthChk;
		$pt->risk2_6other_input = $request->risk2_6OtherInput;
		$pt->risk2_6arrive_date = $this->convertDateToMySQL($request->risk2_6ArriveDate);
		$pt->risk2_6airline_input = $request->risk2_6AirlineInput;
		$pt->risk2_6flight_no_input = $request->risk2_6FlightNoInput;
		$pt->risk2_6seat_no_input = $request->risk2_6SeatNoInput;

		$pt->risk2_6history_chk = $request->risk2_6HistoryChk;
		$pt->risk2_6history_hospital_date = $this->convertDateToMySQL($request->risk2_6HistoryHospitalDate);
		$pt->risk2_6history_hospital_input = $request->risk2_6HistoryHospitalInput;

		$pt->risk2_7chk = $request->risk2_7Chk;
		$pt->risk2_7relation = $request->risk2_7RelationshipInput;
		$pt->risk2_7relation_name = $request->risk2_7RelationNameInput;

		$pt->risk2_8chk = $request->risk2_8Chk;
		$pt->risk2_9chk = $request->risk2_9Chk;
		$pt->risk2_9input = $request->risk2_9Input;

		$pt->risk2_10chk = $request->risk2_10Chk;
		$pt->risk2_10input_name = $request->risk2_10NameInput;
		$pt->risk2_10date = $this->convertDateToMySQL($request->risk2_10Date);
		$pt->risk2_10input_symptom = $request->risk2_10SymptomInput;
		$pt->risk2_10input_diag = $request->risk2_10DiagInput;
		$pt->risk2_10input_diage_hospital = $request->risk2_10HospitalInput;
		$pt->risk2_10input_relation = $request->risk2_10ConnectInput;

		$pt->data3_1date_sickdate = $this->convertDateToMySQL($request->risk3_1sickDateInput);
		$pt->data3_2input_treat = $request->risk3_2firstTreatInput;
		$pt->data3_2date_treat = $this->convertDateToMySQL($request->risk3_2treatDateInput);
		$pt->data3_2chk_patient_type = $request->risk3_2patientTypeChk;
		$pt->data3_2input_admit = $request->risk3_2admitPlaceInput;
		$pt->data3_2date_admit = $this->convertDateToMySQL($request->risk3_2admitDateInput);

		$pt->data3_3chk = $request->risk3_3Chk;
		$pt->data3_3chk_lung = $request->risk3_3LungChk;
		$pt->data3_3chk_heart = $request->risk3_3HeartChk;
		$pt->data3_3chk_cirrhosis = $request->risk3_3CirrhosisChk;
		$pt->data3_3chk_kidney = $request->risk3_3KidneyChk;
		$pt->data3_3chk_diabetes = $request->risk3_3DiabetesChk;
		$pt->data3_3chk_blood = $request->risk3_3BloodChk;
		$pt->data3_3chk_immune = $request->risk3_3ImmuneChk;
		$pt->data3_3chk_anaemia = $request->risk3_3AnaemiaChk;
		$pt->data3_3chk_cerebral = $request->risk3_3CerebralChk;
		$pt->data3_3chk_pregnant = $request->risk3_3PregnantChk;
		$pt->data3_3input_pregnant_week = $request->risk3_3PregnanWeekInput;
		$pt->data3_3chk_fat = $request->risk3_3FatChk;
		$pt->data3_3_fat_height = $request->risk3_3FatHeightInput;
		$pt->data3_3_fat_weight = $request->risk3_3FatWeightInput;
		$pt->data3_3_fat_bmi = $request->risk3_3FatBmiInput;
		$pt->data3_3chk_cancer = $request->risk3_3CancerChk;
		$pt->data3_3chk_cancer_name = $request->risk3_3CancerInput;
		$pt->data3_3chk_other = $request->risk3_3OtherChk;
		$pt->data3_3input_other = $request->risk3_3OtherInput;

		$pt->data3_3chk_smoking_history = $request->risk3_3SmokingHistoryChk;
		$pt->data3_3chk_smoking_yes = $request->risk3_3SmokingChkYes;
		$pt->data3_3chk_smokingYes_input = $request->risk3_3SmokingChkYesInput;
		$pt->data3_3chk_smoking_no = $request->risk3_3SmokingChkNo;
		$pt->data3_3chk_smoking_no_input = $request->risk3_3SmokingChkNoInput;

		$pt->data3_3chk_drink_history = $request->risk3_3DrinkHistoryChk;
		$pt->data3_3chk_drink_yes_chk = $request->risk3_3DrinkChkYes;
		$pt->data3_3chk_drink_yes_input = $request->risk3_3DrinkChkYesInput;
		$pt->data3_3chk_drink_no_chk = $request->risk3_3DrinkChkNo;
		$pt->data3_3chk_drink_no_input = $request->risk3_3DrinkChkNoInput;

		$pt->data3_4chk = $request->risk3_4influVaccineChk;
		$pt->data3_4chk_yes_date = $this->convertDateToMySQL($request->risk3_4influVaccineChkYesInput);

		$pt->data3_5_input_symptom = $request->risk3_5SymptomInput;

		$pt->data3_6sick_date = $this->convertDateToMySQL($request->data3_6sickDate);
		$pt->data3_temp = $request->data3_6TempInput;
		$pt->data3_6fever = $request->data3_6_0FeverChk;
		$pt->data3_6cough = $request->data3_6_0CoughChk;
		$pt->data3_6sore = $request->data3_6_0SoreChk;
		$pt->data3_6snot = $request->data3_6_0SnotChk;
		$pt->data3_6sputum = $request->data3_6_0SputumChk;
		$pt->data3_6breathe = $request->data3_6_0BreatheChk;
		$pt->data3_6gasp = $request->data3_6_0GaspChk;
		$pt->data3_6muscle = $request->data3_6_0MuscleChk;
		$pt->data3_6headache = $request->data3_6_0HeadacheChk;
		$pt->data3_6liquid = $request->data3_6_0LiquidChk;

		$pt->data3_6oth_symptom = $request->data3_6SymptomOtherInput;
		$pt->data3_6breathing_tube_chk = $request->data3_6BreathingTubeChk;
		$pt->data3_6breathing_tube_date = $this->convertDateToMySQL($request->data3_6BreathingTubeDate);

		$pt->data3_6antivirus_chk = $request->data3_6AntiVirusDrugChk;
		$pt->data3_6antivirus_name = $request->data3_6AntiVirusDrugInput;
		$pt->data3_6antivirus_size = $request->data3_6AntiVirusDrugSizeInput;
		$pt->data3_6antivirus_start_date = $this->convertDateToMySQL($request->data3_6AntiVirusDrugStartDate);
		$pt->data3_6antivirus_end_date = $this->convertDateToMySQL($request->data3_6AntiVirusDrugEndDate);

		$pt_saved = $pt->save();
		if ($pt_saved) {
			return redirect()->route('investList.index');
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TitleName;
use App\Provinces;
use App\InvestList;
use App\Occupation;
use DB;
class ConfirmFormController extends Controller
{

	public function index()
	{
		//
	}

	public function create(Request $request)
	{
		$invest_pt = InvestList::find($request->id)->get()->toArray();
		$titleName = TitleName::all()->toArray();
		$provinces = Provinces::all()->toArray();
		$occupation = Occupation::all()->keyBy('id')->toArray();

		return view('form.confirm.index',
			[
				'invest_pt' => $invest_pt,
				'titleName' => $titleName,
				'provinces' => $provinces,
				'occupation' => $occupation
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
		$pt->risk2_2date = $request->risk2_2Date;
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
		$pt->risk2_6date_arrive = $request->risk2_6DateArrive;
		$pt->risk2_6arrive_reason = $request->risk2_6ReasonInput;
		$pt->risk2_6workchk = $request->risk2_6WorkChk;
		$pt->risk2_6work_type = $request->risk2_6WorkTypeInput;
		$pt->risk2_6work_place = $request->risk2_6WorkPlaceInput;
		$pt->risk2_6work_duration = $request->risk2_6WorkDurationInput;
		$pt->risk2_6meeting_chk = $request->risk2_6MeetingChk;
		$pt->risk2_6meeting_place = $request->risk2_6MeetingPlaceInput;
		$pt->risk2_6meeting_date = $request->risk2_6MeetingDate;
		$pt->risk2_6study_chk = $request->risk2_6StudyChk;
		$pt->risk2_6study_name = $request->risk2_6StudyNameInput;
		$pt->risk2_6study_duration = $request->risk2_6StudyDurationInput;
		$pt->risk2_6visit_chk = $request->risk2_6VisitChk;
		$pt->risk2_6visit_house_no = $request->risk2_6VisitHouseNoInput;
		$pt->risk2_6visit_duration = $request->risk2_6VisitDurationInput;
		$pt->risk2_6travel_chk = $request->risk2_6TravelChk;

		$pt->risk2_6travel_acc1_input = $request->risk2_6Activity1Input;
		$pt->risk2_6travel_acc1_place = $request->risk2_6Activity1PlaceInput;
		$pt->risk2_6travel_acc1_date = $request->risk2_6Activity1DateInput;

		$pt->risk2_6travel_acc2_input = $request->risk2_6Activity2Input;
		$pt->risk2_6travel_acc2_place = $request->risk2_6Activity2PlaceInput;
		$pt->risk2_6travel_acc2_date = $request->risk2_6Activity2DateInput;

		$pt->risk2_6travel_acc3_input = $request->risk2_6Activity3Input;
		$pt->risk2_6travel_acc3_place = $request->risk2_6Activity3PlaceInput;
		$pt->risk2_6travel_acc3_date = $request->risk2_6Activity3DateInput;

		$pt->risk2_6travel_acc4_input = $request->risk2_6Activity4Input;
		$pt->risk2_6travel_acc4_place = $request->risk2_6Activity4PlaceInput;
		$pt->risk2_6travel_acc4_date = $request->risk2_6Activity4DateInput;

		$pt->risk2_6travel_acc5_input = $request->risk2_6Activity5Input;
		$pt->risk2_6travel_acc5_place = $request->risk2_6Activity5PlaceInput;
		$pt->risk2_6travel_acc5_date = $request->risk2_6Activity5DateInput;

		$pt->risk2_6other_chk = $request->risk2_6MeetingChk;
		$pt->risk2_6other_input = $request->risk2_6OtherInput;
		$pt->risk2_6arrive_date = $request->risk2_6ArriveDate;
		$pt->risk2_6airline_input = $request->risk2_6AirlineInput;
		$pt->risk2_6flight_no_input = $request->risk2_6FlightNoInput;
		$pt->risk2_6seat_no_input = $request->risk2_6SeatNoInput;
		$pt->risk2_6history_chk = $request->risk2_6HistoryChk;
		$pt->risk2_6history_hospital_date = $request->risk2_6HistoryHospitalDate;
		$pt->risk2_6history_hospital_input = $request->risk2_6HistoryHospitalInput;

		$pt->risk2_7chk = $request->risk2_7Chk;
		$pt->risk2_7relation = $request->risk2_7RelationshipInput;
		$pt->risk2_7relation_name = $request->risk2_7RelationNameInput;

		$pt->risk2_8chk = $request->risk2_8Chk;
		$pt->risk2_9chk = $request->risk2_9Chk;
		$pt->risk2_9input = $request->risk2_9Input;

		$pt->risk2_10chk = $request->risk2_10Chk;
		$pt->risk2_10input_name = $request->risk2_10NameInput;
		$pt->risk2_10date = $request->risk2_10Date;
		$pt->risk2_10input_symptom = $request->risk2_10SymptomInput;
		$pt->risk2_10input_diag = $request->risk2_10DiagInput;
		$pt->risk2_10input_diage_hospital = $request->risk2_10HospitalInput;
		$pt->risk2_10input_relation = $request->risk2_10ConnectInput;

		$pt->data3_1date_sickdate = $request->risk3_1sickDateInput;
		$pt->data3_2input_treat = $request->risk3_2firstTreatInput;
		$pt->data3_2date_treat = $request->risk3_2treatDateInput;
		$pt->data3_2chk_patient_type = $request->risk3_2patientTypeChk;
		$pt->data3_2input_admit = $request->risk3_2admitPlaceInput;
		$pt->data3_2date_admit = $request->risk3_2admitDateInput;

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
		$pt->data3_4chk_yes_date = $request->risk3_4influVaccineChkYesInput;

		$pt->data3_5_input_symptom = $request->risk3_5SymptomInput;

		$pt->data3_6sick_date = $request->data3_6sickDate;
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
		$pt->data3_6breathing_tube_date = $request->data3_6BreathingTubeDate;

		$pt->data3_6antivirus_chk = $request->data3_6AntiVirusDrugChk;
		$pt->data3_6antivirus_name = $request->data3_6AntiVirusDrugInput;
		$pt->data3_6antivirus_size = $request->data3_6AntiVirusDrugSizeInput;
		$pt->data3_6antivirus_start_date = $request->data3_6AntiVirusDrugStartDate;
		$pt->data3_6antivirus_end_date = $request->data3_6AntiVirusDrugEndDate;


		$pt_saved = $pt->save();


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

	public function subDistrictFetch(Request $request) {
		$coll = self::subDistrictByDistrict($request->id);
		$sub_districts = $coll->keyBy('sub_district_id');
		$htm = "<option value=\"0\">-- โปรดเลือก --</option>";
		foreach ($sub_districts as $key => $val) {
			$htm .= "<option value=\"".$val->sub_district_id."\">".$val->sub_district_name."</option>";
		}
		return $htm;
	}
}

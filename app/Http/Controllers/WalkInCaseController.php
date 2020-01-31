<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TitleName;
use App\Provinces;
use App\Nationality;
use App\InvestList;
use App\LaboratoryLists;
use App\PathogenLists;
use App\Occupation;

class WalkInCaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return view('walk-in.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $laboratorylists = LaboratoryLists::all()->toArray();
      $pathogenlists = PathogenLists::all()->toArray();
      $titleName = TitleName::all()->toArray();
      $provinces = Provinces::all()->toArray();
      $nationality = Nationality::all()->toArray();
      $occupation = Occupation::all()->toArray();
      return view('walk-in.create',
        [
          'titleName'=>$titleName,
          'provinces'=>$provinces,
          'nationality'=>$nationality,
          'laboratorylists'=>$laboratorylists,
          'pathogenlists'=>$pathogenlists,
          'occupation'=>$occupation
        ]
      );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //dd($this->Convert_Date($request->risk2_6ArriveDate));

        //dd($request);
        $data = [
          "screen_pt" => (!empty($request->screen_pt)) ? trim($request->screen_pt) : "1",
          "title_name" => (!empty($request->title_name)) ? trim($request->title_name) : "",
          "first_name" => (!empty($request->first_name)) ? trim($request->first_name) : "",
          "mid_name" => (!empty($request->mid_name)) ? trim($request->mid_name) : "",
          "last_name" => (!empty($request->last_name)) ? trim($request->last_name) : "",
          "sex" => (!empty($request->sex)) ? trim($request->sex) : "",
          "age" => (!empty($request->age)) ? trim($request->age) : "",
          "nation" => (!empty($request->nation)) ? trim($request->nation) : "",
          "race" => (!empty($request->race)) ? trim($request->race) : "",
          "occupation" => (!empty($request->occupation)) ? trim($request->occupation) : "",
          "occupation_oth" => (!empty($request->occupation_oth)) ? trim($request->occupation_oth) : "",

          //"congential" => (!empty($request->congential)) ? trim($request->congential) : "",
          "data3_3chk" => (!empty($request->data3_3chk)) ? trim($request->data3_3chk) : "n",
          "data3_3chk_lung" => (!empty($request->data3_3chk_lung)) ? trim($request->data3_3chk_lung) : "n",
          "data3_3chk_heart" => (!empty($request->data3_3chk_heart)) ? trim($request->data3_3chk_heart) : "n",
          "data3_3chk_cirrhosis" => (!empty($request->data3_3chk_cirrhosis)) ? trim($request->data3_3chk_cirrhosis) : "n",
          "data3_3chk_kidney" => (!empty($request->data3_3chk_kidney)) ? trim($request->data3_3chk_kidney) : "n",
          "data3_3chk_diabetes" => (!empty($request->data3_3chk_diabetes)) ? trim($request->data3_3chk_diabetes) : "n",
          "data3_3chk_blood" => (!empty($request->data3_3chk_blood)) ? trim($request->data3_3chk_blood) : "n",
          "data3_3chk_immune" => (!empty($request->data3_3chk_immune)) ? trim($request->data3_3chk_immune) : "n",
          "data3_3chk_anaemia" => (!empty($request->data3_3chk_anaemia)) ? trim($request->data3_3chk_anaemia) : "n",
          "data3_3chk_cerebral" => (!empty($request->data3_3chk_cerebral)) ? trim($request->data3_3chk_cerebral) : "n",
          "data3_3chk_pregnant" => (!empty($request->data3_3chk_pregnant)) ? trim($request->data3_3chk_pregnant) : "n",
          "data3_3chk_fat" => (!empty($request->data3_3chk_fat)) ? trim($request->data3_3chk_fat) : "n",
          "data3_3chk_cancer" => (!empty($request->data3_3chk_cancer)) ? trim($request->data3_3chk_cancer) : "n",
          "data3_3chk_cancer_name" => (!empty($request->data3_3chk_cancer_name)) ? trim($request->data3_3chk_cancer_name) : "",
          "data3_3chk_other" => (!empty($request->data3_3chk_other)) ? trim($request->data3_3chk_other) : "n",
          "data3_3input_other" => (!empty($request->data3_3input_other)) ? trim($request->data3_3input_other) : "",

          "walkinplace_hosp" => (!empty($request->walkinplace_hosp)) ? trim($request->walkinplace_hosp) : "",
          "negative_pressure" => (!empty($request->negative_pressure)) ? trim($request->negative_pressure) : "",
          "refer_car" => (!empty($request->refer_car)) ? trim($request->refer_car) : "",
          "risk2_6history_hospital_input" => (!empty($request->risk2_6HistoryHospitalInput)) ? trim($request->risk2_6HistoryHospitalInput) : "",
          "isolated_province" => (!empty($request->isolated_province)) ? trim($request->isolated_province) : "",
          "risk2_6arrive_date" => (!empty($request->risk2_6ArriveDate)) ? $this->Convert_Date($request->risk2_6ArriveDate) : NULL,
          "risk2_6airline_input" => (!empty($request->risk2_6AirlineInput)) ? trim($request->risk2_6AirlineInput) : "",
          "risk2_6flight_no_input" => (!empty($request->risk2_6FlightNoInput)) ? trim($request->risk2_6FlightNoInput) : "",
          "total_travel_in_group" => (!empty($request->total_travel_in_group)) ? trim($request->total_travel_in_group) : "",
          "data3_1date_sickdate" => (!empty($request->risk3_1sickDateInput)) ? $this->Convert_Date($request->risk3_1sickDateInput) : NULL,
          "fever_current" => (!empty($request->fever)) ? trim($request->fever) : "",
          "sym_cough" => (!empty($request->sym_cough)) ? trim($request->sym_cough) : "n",
          "sym_snot" => (!empty($request->sym_snot)) ? trim($request->sym_snot) : "n",
          "sym_sore" => (!empty($request->sym_sore)) ? trim($request->sym_sore) : "n",
          "sym_dyspnea" => (!empty($request->sym_dyspnea)) ? trim($request->sym_dyspnea) : "n",
          "sym_breathe" => (!empty($request->sym_breathe)) ? trim($request->sym_breathe) : "n",
          "sym_stufefy" => (!empty($request->sym_stufefy)) ? trim($request->sym_stufefy) : "n",
          "rr_rpm" => (!empty($request->rr_rpm)) ? trim($request->rr_rpm) : "",
          "xray_result" => (!empty($request->xray_result)) ? trim($request->xray_result) : "",
          "rapid_test_result" => (!empty($request->rapid_test_result)) ? trim($request->rapid_test_result) : "",
          "lab_test_result_other" => (!empty($request->lab_test_result_other)) ? trim($request->lab_test_result_other) : "",
          "first_diag" => (!empty($request->first_diag)) ? trim($request->first_diag) : "",

          "nps_ts1_date" => (!empty($request->nps_ts1_date)) ? $this->Convert_Date($request->nps_ts1_date) : NULL,
          "nps_ts1_send" => (!empty($request->nps_ts1_send)) ? trim($request->nps_ts1_send) : "0",
          "nps_ts1_result" => (!empty($request->nps_ts1_result)) ? trim($request->nps_ts1_result) : "0",

          "nps_ts2_date" => (!empty($request->nps_ts2_date)) ? $this->Convert_Date($request->nps_ts2_date) : NULL,
          "nps_ts2_send" => (!empty($request->nps_ts2_send)) ? trim($request->nps_ts2_send) : "0",
          "nps_ts2_result" => (!empty($request->nps_ts2_result)) ? trim($request->nps_ts2_result) : "0",

          "cb_date" => (!empty($request->cb_date)) ? $this->Convert_Date($request->cb_date) : NULL,
          "cb_send" => (!empty($request->cb_send)) ? trim($request->cb_send) : "0",
          "cb_result" => (!empty($request->cb_result)) ? trim($request->cb_result) : "0",

          "sat_id" => (!empty($request->sat_id)) ? trim($request->sat_id) : NULL,
          "letter_division_code" => (!empty($request->letter_division_code)) ? trim($request->letter_division_code) : "",
          "letter_code" => (!empty($request->letter_code)) ? trim($request->letter_code) : "",
          "refer_bidi" => (!empty($request->refer_bidi)) ? trim($request->refer_bidi) : "",
          "refer_lab" => (!empty($request->refer_lab)) ? trim($request->refer_lab) : "",
          "lab_send_detail" => (!empty($request->lab_send_detail)) ? trim($request->lab_send_detail) : "",
          "lab_send_date" => (!empty($request->lab_send_date)) ? $this->Convert_Date($request->lab_send_date) : NULL,
          "not_send_bidi" => (!empty($request->not_send_bidi)) ? trim($request->not_send_bidi) : "",
          "op_opt" => (!empty($request->op_opt)) ? trim($request->op_opt) : "",
          "op_dpc" => (!empty($request->op_dpc)) ? trim($request->op_dpc) : "",
          "pt_status" => (!empty($request->pt_status)) ? trim($request->pt_status) : "1",
          "news_st" => (!empty($request->news_st)) ? trim($request->news_st) : "1",
          "disch_st" => (!empty($request->disch_st)) ? trim($request->disch_st) : "1",
          "coordinator_tel" => (!empty($request->coordinator_tel)) ? trim($request->coordinator_tel) : "",
          "send_information" => (!empty($request->send_information)) ? trim($request->send_information) : "",
          "send_information_div" => (!empty($request->send_information_div)) ? trim($request->send_information_div) : "",
          "receive_information" => (!empty($request->receive_information)) ? trim($request->receive_information) : "",
        ];

        $result = InvestList::insert($data);

        if($result){
          return redirect()->route('walkincase.create');
        }
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

    public function Convert_Date($strDate){
      //dd($strDate);
      $strDate_arr = explode("/",$strDate);
      $year = $strDate_arr['2'];
      $month = $strDate_arr['1'];
      $day = $strDate_arr['0'];
      // $strFullThaiDate = $day.'/'.$month.'/'.$year;
      $strFullThaiDate = $year.'-'.$month.'-'.$day;
      return $strFullThaiDate;
    }
}

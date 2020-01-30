<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TitleName;
use App\Provinces;
use App\Nationality;
use App\InvestList;

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
      $titleName = TitleName::all()->toArray();
      $provinces = Provinces::all()->toArray();
      $nationality = Nationality::all()->toArray();
      return view('walk-in.create',
        [
          'titleName'=>$titleName,
          'provinces'=>$provinces,
          'nationality'=>$nationality
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
          "title_name" => (!empty($request->title_name)) ? trim($request->title_name) : "",
          "first_name" => (!empty($request->first_name)) ? trim($request->first_name) : "",
          "mid_name" => (!empty($request->mid_name)) ? trim($request->mid_name) : "",
          "last_name" => (!empty($request->last_name)) ? trim($request->last_name) : "",
          "sex" => (!empty($request->sex)) ? trim($request->sex) : "",
          "age" => (!empty($request->age)) ? trim($request->age) : "",
          "nation" => (!empty($request->nation)) ? trim($request->nation) : "",
          "race" => (!empty($request->race)) ? trim($request->race) : "",
          "occupation" => (!empty($request->occupation)) ? trim($request->occupation) : "",
          "congential" => (!empty($request->congential)) ? trim($request->congential) : "",
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
          "sym_cough" => (!empty($request->sym_cough)) ? trim($request->sym_cough) : "",
          "sym_sore" => (!empty($request->sym_sore)) ? trim($request->sym_sore) : "",
          "sym_dyspnea" => (!empty($request->sym_dyspnea)) ? trim($request->sym_dyspnea) : "",
          "rr_rpm" => (!empty($request->rr_rpm)) ? trim($request->rr_rpm) : "",
          "xray_result" => (!empty($request->xray_result)) ? trim($request->xray_result) : "",
          "rapid_test_result" => (!empty($request->rapid_test_result)) ? trim($request->rapid_test_result) : "",
          "lab_test_result_other" => (!empty($request->lab_test_result_other)) ? trim($request->lab_test_result_other) : "",
          "first_diag" => (!empty($request->first_diag)) ? trim($request->first_diag) : "",
          "sat_id" => (!empty($request->sat_id)) ? trim($request->sat_id) : "",
          "letter_division_code" => (!empty($request->letter_division_code)) ? trim($request->letter_division_code) : "",
          "letter_code" => (!empty($request->letter_code)) ? trim($request->letter_code) : "",
          "refer_bidi" => (!empty($request->refer_bidi)) ? trim($request->refer_bidi) : "",
          "refer_lab" => (!empty($request->refer_lab)) ? trim($request->refer_lab) : "",
          "lab_send_detail" => (!empty($request->lab_send_detail)) ? trim($request->lab_send_detail) : "",
          "lab_send_date" => (!empty($request->lab_send_date)) ? $this->Convert_Date($request->lab_send_date) : NULL,
          "not_send_bidi" => (!empty($request->not_send_bidi)) ? trim($request->not_send_bidi) : "",
          "op_opt" => (!empty($request->op_opt)) ? trim($request->op_opt) : "",
          "op_dpc" => (!empty($request->op_dpc)) ? trim($request->op_dpc) : "",
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

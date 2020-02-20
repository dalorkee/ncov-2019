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
use App\GlobalCountry;
use App\GlobalCity;
use App\AirportLists;
use Auth;
use DB;
use Carbon\Carbon;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class ScreenPUIController extends MasterController
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

      $entry_user = Auth::user()->id;
      $prefix_sat_id = Auth::user()->prefix_sat_id;
      $laboratorylists = LaboratoryLists::all()->toArray();
      $pathogenlists = PathogenLists::all()->toArray();
      $titleName = TitleName::all()->toArray();
      $provinces = Provinces::all()->toArray();
      $nationality = Nationality::all()->toArray();
      $occupation = Occupation::all()->toArray();
      $globalcountry = GlobalCountry::all();
      $airportlists = AirportLists::all()->toArray();
      $arr = parent::getStatus();
      //return view('screen-pui.create',
      return view('screen-pui.create120263',
        [
          'titleName' => $titleName,
          'provinces' => $provinces,
          'nationality' => $nationality,
          'laboratorylists' => $laboratorylists,
          'pathogenlists' => $pathogenlists,
          'occupation' => $occupation,
          'arr' => $arr,
          'entry_user' => $entry_user,
          'globalcountry' => $globalcountry,
          'prefix_sat_id' => $prefix_sat_id,
          'airportlists' => $airportlists,
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
      $prefix_sat_id = Auth::user()->prefix_sat_id;
      //Auto
      if($request->pui_code_gen==1){
        if (InvestList::where('sat_id_temp', '=', $request->sat_id)->exists()) {
             // dup
             //dd('dup');
             $config = [
                 'table' => 'invest_pt',
                 'length' => 11,
                'field' => 'sat_id_temp',
                 'prefix' => $prefix_sat_id."O".date('d').date('m'),
             ];
             $sat_id_gen = IdGenerator::generate($config);
             $tmp = trim($sat_id_gen);
             //dd('dup>>'.$sat_id);
             $tmp_sat_id = explode("O",$sat_id_gen);
             $patient_type_sat_id = trim($request->patient_type_sat_id);
             $sat_id = $tmp_sat_id['0'].$patient_type_sat_id.$tmp_sat_id['1'];
        }else{
             $tmp = trim($request->sat_id);
             $tmp_sat_id = explode("O",$request->sat_id);
             $patient_type_sat_id = trim($request->patient_type_sat_id);
             $sat_id = $tmp_sat_id['0'].$patient_type_sat_id.$tmp_sat_id['1'];
        }
      //Manual
      }elseif($request->pui_code_gen==2){
          $sat_id = trim($request->sat_id);
      }

      $order_pt = (!empty($request->order_pt)) ? trim($request->order_pt) : NULL;

      // if(!is_null($order_pt)){
      //   $check_duplicate_record_order_pt = InvestList::where('order_pt', '=', $request->order_pt)->exists();
      //   if($check_duplicate_record_order_pt){
      //     //return redirect()->route('screenpui.create')->with('message','Duplicate SATID: '.$sat_id);
      //     return redirect()->back()->withInput()->with('message','ลำดับผู้ป่วย Confirm ซ้ำ ที่ SATID :'.$sat_id);
      //   }
      // }

      $check_duplicate_record = InvestList::where('sat_id', '=', $request->sat_id)->exists();
      if($check_duplicate_record){
        //return redirect()->route('screenpui.create')->with('message','Duplicate SATID: '.$sat_id);
        return redirect()->back()->withInput()->with('message','Duplicate SATID: '.$sat_id);
      }

        $data = [
          "notify_date" => (!empty($request->notify_date)) ? trim($this->Convert_Date($request->notify_date)) : date('Y-m-d'),
          "notify_time" => (!empty($request->notify_time)) ? trim($request->notify_time.":00") : NULL,
          "screen_pt" => (!empty($request->screen_pt)) ? trim($request->screen_pt) : "1",
          "airports_code" => (!empty($request->airports_code)) ? trim($request->airports_code) : NULL,
          "walkinplace_hosp_province" => (!empty($request->walkinplace_hosp_province)) ? trim($request->walkinplace_hosp_province) : NULL,
          "walkinplace_hosp_code" => (!empty($request->walkinplace_hosp_code)) ? trim($request->walkinplace_hosp_code) : NULL,
          "isolated_province" => (!empty($request->isolated_province)) ? trim($request->isolated_province) : NULL,
          "isolated_hosp_code" => (!empty($request->isolated_hosp_code)) ? trim($request->isolated_hosp_code) : NULL,
          "title_name" => (!empty($request->title_name)) ? trim($request->title_name) : NULL,
          "first_name" => (!empty($request->first_name)) ? trim($request->first_name) : NULL,
          "mid_name" => (!empty($request->mid_name)) ? trim($request->mid_name) : NULL,
          "last_name" => (!empty($request->last_name)) ? trim($request->last_name) : NULL,
          "sex" => (!empty($request->sex)) ? trim($request->sex) : NULL,
          "age" => (!empty($request->age)) ? trim($request->age) : NULL,
          "nation" => (!empty($request->nation)) ? trim($request->nation) : NULL,
          "race" => (!empty($request->race)) ? trim($request->race) : NULL,
          "occupation" => (!empty($request->occupation)) ? trim($request->occupation) : NULL,
          "occupation_oth" => (!empty($request->occupation_oth)) ? trim($request->occupation_oth) : NULL,
          "travel_from_country" => (!empty($request->travel_from_country)) ? trim($request->travel_from_country) : NULL,
          "travel_from_city" => (!empty($request->travel_from_city)) ? trim($request->travel_from_city) : NULL,

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
          "data3_3chk_cancer_name" => (!empty($request->data3_3chk_cancer_name)) ? trim($request->data3_3chk_cancer_name) : NULL,
          "data3_3chk_other" => (!empty($request->data3_3chk_other)) ? trim($request->data3_3chk_other) : "n",
          "data3_3input_other" => (!empty($request->data3_3input_other)) ? trim($request->data3_3input_other) : NULL,

          "walkinplace_hosp" => (!empty($request->walkinplace_hosp)) ? trim($request->walkinplace_hosp) : NULL,
          "negative_pressure" => (!empty($request->negative_pressure)) ? trim($request->negative_pressure) : NULL,
          "refer_car" => (!empty($request->refer_car)) ? trim($request->refer_car) : NULL,
          "risk2_6history_hospital_input" => (!empty($request->risk2_6history_hospital_input)) ? trim($request->risk2_6history_hospital_input) : NULL,
          "isolated_province" => (!empty($request->isolated_province)) ? trim($request->isolated_province) : NULL,
          "risk_stay_outbreak_arrive_date" => (!empty($request->risk2_6arrive_date)) ? trim($this->Convert_Date($request->risk2_6arrive_date)) : NULL,
          "risk_stay_outbreak_airline" => (!empty($request->risk2_6airline_input)) ? trim($request->risk2_6airline_input) : NULL,
          "risk_stay_outbreak_flight_no" => (!empty($request->risk2_6flight_no_input)) ? trim($request->risk2_6flight_no_input) : NULL,
          "total_travel_in_group" => (!empty($request->total_travel_in_group)) ? trim($request->total_travel_in_group) : NULL,
          "data3_1date_sickdate" => (!empty($request->data3_1date_sickdate)) ? trim($this->Convert_Date($request->data3_1date_sickdate)) : NULL,
          "fever_current" => (!empty($request->fever)) ? trim($request->fever) : NULL,
          "fever_history" => (!empty($request->fever_history)) ? trim($request->fever_history) : "n",
          "sym_cough" => (!empty($request->sym_cough)) ? trim($request->sym_cough) : "n",
          "sym_snot" => (!empty($request->sym_snot)) ? trim($request->sym_snot) : "n",
          "sym_sore" => (!empty($request->sym_sore)) ? trim($request->sym_sore) : "n",
          "sym_dyspnea" => (!empty($request->sym_dyspnea)) ? trim($request->sym_dyspnea) : "n",
          "sym_breathe" => (!empty($request->sym_breathe)) ? trim($request->sym_breathe) : "n",
          "sym_stufefy" => (!empty($request->sym_stufefy)) ? trim($request->sym_stufefy) : "n",
          "rr_rpm" => (!empty($request->rr_rpm)) ? trim($request->rr_rpm) : NULL,
          "xray_result" => (!empty($request->xray_result)) ? trim($request->xray_result) : NULL,
          "lab_rapid_test_result" => (!empty($request->rapid_test_result)) ? trim($request->rapid_test_result) : NULL,
          "lab_other_result" => (!empty($request->lab_test_result_other)) ? trim($request->lab_test_result_other) : NULL,
          "first_diag" => (!empty($request->first_diag)) ? trim($request->first_diag) : NULL,

          "sat_id" => (!empty($sat_id)) ? trim($sat_id) : NULL,
          "sat_id_temp" => (!empty($tmp)) ? trim($tmp) : NULL,
          "sat_id_class" => "Q",
          "letter_division_code" => (!empty($request->letter_division_code)) ? trim($request->letter_division_code) : NULL,
          "letter_code" => (!empty($request->letter_code)) ? trim($request->letter_code) : NULL,
          "refer_bidi" => (!empty($request->refer_bidi)) ? trim($request->refer_bidi) : NULL,
          "refer_lab" => (!empty($request->refer_lab)) ? trim($request->refer_lab) : NULL,
          "lab_send_detail" => (!empty($request->lab_send_detail)) ? trim($request->lab_send_detail) : NULL,
          "lab_send_date" => (!empty($request->lab_send_date)) ? trim($this->Convert_Date($request->lab_send_date)) : NULL,
          "not_send_bidi" => (!empty($request->not_send_bidi)) ? trim($request->not_send_bidi) : NULL,
          "op_opt" => (!empty($request->op_opt)) ? trim($request->op_opt) : NULL,
          "op_dpc" => (!empty($request->op_dpc)) ? trim($request->op_dpc) : NULL,
          "pt_status" => (!empty($request->pt_status)) ? trim($request->pt_status) : "1",
          "order_pt" => $order_pt,
          "pui_type" => (!empty($request->pui_type)) ? trim($request->pui_type) : NULL,
          "news_st" => (!empty($request->news_st)) ? trim($request->news_st) : NULL,
          "disch_st" => (!empty($request->disch_st)) ? trim($request->disch_st) : NULL,
          "coordinator_tel" => (!empty($request->coordinator_tel)) ? trim($request->coordinator_tel) : NULL,
          "send_information" => (!empty($request->send_information)) ? trim($request->send_information) : NULL,
          "send_information_div" => (!empty($request->send_information_div)) ? trim($request->send_information_div) : NULL,
          "receive_information" => (!empty($request->receive_information)) ? trim($request->receive_information) : NULL,
          "entry_user" => (!empty($request->entry_user)) ? trim($request->entry_user) : NULL,
          //"created_at" => date('Y-m-d H:i:s'),
          "created_at" => Carbon::now(),
          "sat" => "y",
        ];

        $result = InvestList::insert($data);

        if($result){
          return redirect()->route('screenpui.create')->with('message','Insert Success SATID: '.$sat_id);
        }else{
          return redirect()->route('screenpui.create')->with('message','Error');
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
        //dd(InvestList::find($id));
        $entry_user = Auth::user()->id;
        $laboratorylists = LaboratoryLists::all()->toArray();
        $pathogenlists = PathogenLists::all()->toArray();
        $titleName = TitleName::all()->toArray();
        $provinces = Provinces::all()->toArray();
        $nationality = Nationality::all()->toArray();
        $occupation = Occupation::all()->toArray();
        $airportlists = AirportLists::all()->toArray();
        $arr_globalcountry = GlobalCountry::select('country_id','country_name')->get()->toArray();
        foreach($arr_globalcountry as $val){
            $globalcountry[$val['country_id']] = $val['country_name'];
        }

        $arr = parent::getStatus();
        $data = InvestList::find($id);

        $work_city = GlobalCity::where('city_id', '=', $data->travel_from_city)->get()->toArray();
        $walkinplace_hosp_name = DB::table('chospital_new')->where('hospcode',$data->walkinplace_hosp_code)->first();
        $isolated_hosp_name = DB::table('chospital_new')->where('hospcode',$data->isolated_hosp_code)->first();

        if($data==null){
          return abort(404);  //404 page
        }else{
          return view('screen-pui.edit120263',compact('entry_user','laboratorylists','pathogenlists','titleName','provinces','nationality','occupation','arr','data','globalcountry','work_city','airportlists','walkinplace_hosp_name','isolated_hosp_name'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
      //dd($request);


      if($request->pt_status!=2){
        $order_pt = NULL;
      }else{
        $order_pt = (!empty($request->order_pt)) ? trim($request->order_pt) : NULL;
        // if(!is_null($order_pt)){
        //   $check_duplicate_record_order_pt = InvestList::where('order_pt', '=', $request->order_pt)->exists();
        //   if($check_duplicate_record_order_pt){
        //     return redirect()->back()->withInput()->with('message','ลำดับผู้ป่วย Confirm ซ้ำ SATID '.$request->sat_id);
        //   }
        // }
      }


      //dd($request->pt_status);


      $update = InvestList::where('id', $request->id)
              ->update([
                "notify_date" => (!empty($request->notify_date)) ? $this->Convert_Date($request->notify_date) : date('Y-m-d'),
                "notify_time" => (!empty($request->notify_time)) ? $request->notify_time : NULL,
                "screen_pt" => (!empty($request->screen_pt)) ? trim($request->screen_pt) : "1",
                "airports_code" => (!empty($request->airports_code)) ? trim($request->airports_code) : NULL,
                "walkinplace_hosp_province" => (!empty($request->walkinplace_hosp_province)) ? trim($request->walkinplace_hosp_province) : NULL,
                "walkinplace_hosp_code" => (!empty($request->walkinplace_hosp_code)) ? trim($request->walkinplace_hosp_code) : NULL,
                "isolated_province" => (!empty($request->isolated_province)) ? trim($request->isolated_province) : NULL,
                "isolated_hosp_code" => (!empty($request->isolated_hosp_code)) ? trim($request->isolated_hosp_code) : NULL,
                "title_name" => (!empty($request->title_name)) ? trim($request->title_name) : NULL,
                "first_name" => (!empty($request->first_name)) ? trim($request->first_name) : NULL,
                "mid_name" => (!empty($request->mid_name)) ? trim($request->mid_name) : NULL,
                "last_name" => (!empty($request->last_name)) ? trim($request->last_name) : NULL,
                "sex" => (!empty($request->sex)) ? trim($request->sex) : NULL,
                "age" => (!empty($request->age)) ? trim($request->age) : NULL,
                "nation" => (!empty($request->nation)) ? trim($request->nation) : NULL,
                "race" => (!empty($request->race)) ? trim($request->race) : NULL,
                "occupation" => (!empty($request->occupation)) ? trim($request->occupation) : NULL,
                "occupation_oth" => (!empty($request->occupation_oth)) ? trim($request->occupation_oth) : NULL,
                //"travel_from" => (!empty($request->travel_from)) ? trim($request->travel_from) : NULL,
                "travel_from_country" => (!empty($request->travel_from_country)) ? trim($request->travel_from_country) : NULL,
                "travel_from_city" => (!empty($request->travel_from_city)) ? trim($request->travel_from_city) : NULL,
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
                "data3_3chk_cancer_name" => (!empty($request->data3_3chk_cancer_name)) ? trim($request->data3_3chk_cancer_name) : NULL,
                "data3_3chk_other" => (!empty($request->data3_3chk_other)) ? trim($request->data3_3chk_other) : "n",
                "data3_3input_other" => (!empty($request->data3_3input_other)) ? trim($request->data3_3input_other) : NULL,
                //"walkinplace_hosp" => (!empty($request->walkinplace_hosp)) ? trim($request->walkinplace_hosp) : NULL,
                "negative_pressure" => (!empty($request->negative_pressure)) ? trim($request->negative_pressure) : NULL,
                "refer_car" => (!empty($request->refer_car)) ? trim($request->refer_car) : NULL,
                "risk2_6history_hospital_input" => (!empty($request->risk2_6history_hospital_input)) ? trim($request->risk2_6history_hospital_input) : NULL,
                "isolated_province" => (!empty($request->isolated_province)) ? trim($request->isolated_province) : NULL,
                "risk_stay_outbreak_arrive_date" => (!empty($request->risk2_6arrive_date)) ? $this->Convert_Date($request->risk2_6arrive_date) : NULL,
                "risk_stay_outbreak_airline" => (!empty($request->risk2_6airline_input)) ? trim($request->risk2_6airline_input) : NULL,
                "risk_stay_outbreak_flight_no" => (!empty($request->risk2_6flight_no_input)) ? trim($request->risk2_6flight_no_input) : NULL,
                "total_travel_in_group" => (!empty($request->total_travel_in_group)) ? trim($request->total_travel_in_group) : NULL,
                "data3_1date_sickdate" => (!empty($request->data3_1date_sickdate)) ? $this->Convert_Date($request->data3_1date_sickdate) : NULL,
                "fever_current" => (!empty($request->fever)) ? trim($request->fever) : NULL,
                "fever_history" => (!empty($request->fever_history)) ? trim($request->fever_history) : "n",
                "sym_cough" => (!empty($request->sym_cough)) ? trim($request->sym_cough) : "n",
                "sym_snot" => (!empty($request->sym_snot)) ? trim($request->sym_snot) : "n",
                "sym_sore" => (!empty($request->sym_sore)) ? trim($request->sym_sore) : "n",
                "sym_dyspnea" => (!empty($request->sym_dyspnea)) ? trim($request->sym_dyspnea) : "n",
                "sym_breathe" => (!empty($request->sym_breathe)) ? trim($request->sym_breathe) : "n",
                "sym_stufefy" => (!empty($request->sym_stufefy)) ? trim($request->sym_stufefy) : "n",
                "rr_rpm" => (!empty($request->rr_rpm)) ? trim($request->rr_rpm) : NULL,
                "xray_result" => (!empty($request->xray_result)) ? trim($request->xray_result) : NULL,
                "lab_rapid_test_result" => (!empty($request->rapid_test_result)) ? trim($request->rapid_test_result) : NULL,
                "lab_other_result" => (!empty($request->lab_test_result_other)) ? trim($request->lab_test_result_other) : NULL,
                "first_diag" => (!empty($request->first_diag)) ? trim($request->first_diag) : NULL,
                "sat_id" => (!empty($request->sat_id)) ? trim($request->sat_id) : NULL,
                "letter_division_code" => (!empty($request->letter_division_code)) ? trim($request->letter_division_code) : NULL,
                "letter_code" => (!empty($request->letter_code)) ? trim($request->letter_code) : NULL,
                "refer_bidi" => (!empty($request->refer_bidi)) ? trim($request->refer_bidi) : NULL,
                "refer_lab" => (!empty($request->refer_lab)) ? trim($request->refer_lab) : NULL,
                "lab_send_detail" => (!empty($request->lab_send_detail)) ? trim($request->lab_send_detail) : NULL,
                "lab_send_date" => (!empty($request->lab_send_date)) ? $this->Convert_Date($request->lab_send_date) : NULL,
                "not_send_bidi" => (!empty($request->not_send_bidi)) ? trim($request->not_send_bidi) : NULL,
                "op_opt" => (!empty($request->op_opt)) ? trim($request->op_opt) : NULL,
                "op_dpc" => (!empty($request->op_dpc)) ? trim($request->op_dpc) : NULL,
                "pt_status" => trim($request->pt_status),
                "order_pt" => $order_pt,
                "pui_type" => (!empty($request->pui_type)) ? trim($request->pui_type) : NULL,
                "news_st" => (!empty($request->news_st)) ? trim($request->news_st) : NULL,
                "disch_st" => (!empty($request->disch_st)) ? trim($request->disch_st) : NULL,
                "coordinator_tel" => (!empty($request->coordinator_tel)) ? trim($request->coordinator_tel) : NULL,
                "send_information" => (!empty($request->send_information)) ? trim($request->send_information) : NULL,
                "send_information_div" => (!empty($request->send_information_div)) ? trim($request->send_information_div) : NULL,
                "receive_information" => (!empty($request->receive_information)) ? trim($request->receive_information) : NULL,
                "entry_user" => (!empty($request->entry_user)) ? trim($request->entry_user) : NULL,
                      ]);

              return redirect()->route('screenpui.edit', ['id' => $request->id])->with('message','Edit Success!');
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
    public static function Convert_Date_To_Picker($strDate){
      if(empty($strDate)) return "";
      $strDate_arr = explode("-",$strDate);
      $year = $strDate_arr['0'];
      $month = $strDate_arr['1'];
      $day = $strDate_arr['2'];
      // $strFullThaiDate = $day.'/'.$month.'/'.$year;
      $strFullThaiDate = $day.'/'.$month.'/'.$year;
      return $strFullThaiDate;
    }
    public function Sat_FetcHos(Request $request){
		$id=$request->get('select');
		$result=array();
		$query=DB::table('ref_province')
		->join('chospital_new','ref_province.province_id','=','chospital_new.prov_code')
		->select('chospital_new.hospcode','chospital_new.hosp_name','chospital_new.prov_code')
		->where('ref_province.province_id',$id)
		->where('chospital_new.status_code','=',1)
		->get();
    //$output = "";
		$output='<option value=""> -- กรุณาเลือก -- </option>';
			foreach ($query as $row) {
				$output.='<option value="'.$row->hospcode.'">'.$row->hosp_name.'</option>';
			}
			echo $output;
		}
    public function Delete_Sat(Request $request){
      if(empty($request->id)) return abort(500);  //404 page
      //dd($request->id);
      $update = InvestList::where('id', $request->id)
              ->update(["deleted_at" => Carbon::now(),]);
      return redirect()->back()->withInput()->with('message','ลบข้อมูลแล้ว');
    }
}

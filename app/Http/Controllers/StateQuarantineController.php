<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\MasterController;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\CriterionFail;
use App\Provinces;
use App\Nationality;
use Session;
use DB;

class StateQuarantineController extends Controller
{
    function __construct()
    {
      $this->middleware('auth');
      $this->middleware(['role:root|ddc|dpc|pho|hos']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){

      $user_role = Session::get('user_role');
      $user_hosp = auth()->user()->hospcode;
      $user_prov = auth()->user()->prov_code;
      $user_region = auth()->user()->region;
      $provinces = Provinces::all();
      $nationality = DB::table('ref_global_country')->get();

      foreach ($provinces as $value){
        $data_provinces[$value->province_id] = $value->province_name;
      }

      foreach ($nationality as $value2) {
        $data_nationalitys[$value2->country_id] = $value2->country_name_th;
      }


      switch ($user_role) {
  			case 'root':
            $data = CriterionFail::whereNotNull('sat_id')->Orderby('date_create','desc')->get();
    				break;
  			case 'ddc':
  				  $data = CriterionFail::Orderby('date_create','desc')->get();
  					break;
  			case 'dpc':
            $prov_arr = $this->getProvCodeByRegion($user_region=0);
            $data = CriterionFail::whereIn('isolated_province', $prov_arr)->Orderby('date_create','desc')->get();
  					break;
  			case 'pho':
  				  $data = CriterionFail::where('prov_code',$user_prov)->Orderby('date_create','desc')->get();
  					break;
  			case 'hos':
  				  $data = CriterionFail::where('hos_id',$user_hosp)->Orderby('date_create','desc')->get();
  					break;
  			default:
  				return redirect()->route('logout');
  				break;
  		}

        return view('self-quarantine.index',[
             'datas' => $data,
             'provinces' => $data_provinces,
             'nationalitys' => $data_nationalitys,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
}

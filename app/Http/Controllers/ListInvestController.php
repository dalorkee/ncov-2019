<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\DataTables\ListInvestDataTable;
use App\InvestList;
use App\Hospitals;
use App\Provinces;
use App\Http\Controllers\MasterController;
use App\Exports\InvestExport;
use Maatwebsite\Excel\Facades\Excel;
use Session, Helper, DB, Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class ListInvestController extends Controller
{
	public function __construct() {
		$this->middleware('auth');
		$this->middleware('onlyOneUser');
		$this->middleware(['role:root|ddc|dpc|pho|hos']);
	}

	public function index(ListInvestDataTable $dataTable) {
		return $dataTable->render('list-data.invest');
	}

	public function export() {
		return Excel::download(new InvestExport, 'invest.csv');
	}

	public function exportByParams($id = 56) {
		return Excel::download(new InvestExport($id), 'invest.xlsx');
	}

	public function softDeleteInvest(Request $request) {
		$user = auth()->user();
		if ($user->hasPermissionTo('pui-delete')) {
			$user_role = Session::get('user_role');
			$dt = Carbon::today();
			$start_date = $dt->sub('3 days')->toDateString();
			$start_date = $start_date." 00:00:00";
			$end_date = date('Y-m-d H:i:s');
			switch ($user_role) {
				case 'root' :
					$pt = InvestList::where('id', '=', $request->pid)->delete();
					break;
				default :
					$pt = InvestList::where('id', '=', $request->pid)
						->where('entry_user', '=', $user->id)
						->where('pt_status', '!=', '2')
						->whereBetween('created_at', [$start_date, $end_date])
						->delete();
					break;
			}
			if ($pt == 1) {
				Log::notice('User:'.$user->id.' Deleted PID: '.$request->pid);
				return redirect()->back()->with('success', 'ข้อมูลรหัสที่ '.$request->pid.' ถูกลบออกจากระบบแล้ว');
			} else {
				return redirect()->back()->with('error', 'ข้อมูลรหัสที่ '.$request->pid.' ไม่สามารถลบออกจากระบบได้ โปรดตรวจสอบเงื่อนไข');
			}
		} else {
			return redirect()->back()->with('error', 'ท่านไม่มีสิทธิ์ลบข้อมูล !!');
		}
	}

	public function chStatus(Request $request) {
		$pst = InvestList::select('id', 'sat_id', 'pt_status', 'news_st', 'disch_st')
			->where('id', '=', $request->id)
			->first();

		$master = new MasterController;
		$status = $master->getStatus();

		/* pt status */
		//$pt_status = (!empty($pst['pt_status'])) ? $status['pt_status'][$pst['pt_status']] : "-";
		if (is_null($pst['pt_status']) || empty($pst['pt_status']) || $pst['pt_status'] == '0') {
			$pt_status = "-";
		} else {
			$pt_status = $status['pt_status'][$pst['pt_status']];
		}

		/* jump pt status key 3 & 4 */
		$pt_status_opt = "";
		foreach ($status['pt_status'] as $key => $val) {
			if ($key == '3' || $key =='4') {
				continue;
			} else {
				$pt_status_opt .= "<option value=\"".$key."\">".$val."</option>";
			}
		}

		/* news status */
		//$news_st = (!empty($pst['news_st'])) ? $status['news_st'][$pst['news_st']] : "-";
		if (is_null($pst['news_st']) || empty($pst['news_st']) || $pst['news_st'] == '0') {
			$news_st = "-";
		} else {
			$news_st = $status['news_st'][$pst['news_st']];
		}

		$news_st_opt = "";
		foreach ($status['news_st'] as $key => $val) {
			$news_st_opt .= "<option value=\"".$key."\">".$val."</option>";
		}

		/* dischart status */
		//$disch_st = (!empty($pst['disch_st'])) ? $status['disch_st'][$pst['disch_st']] : "-";
		if (is_null($pst['disch_st']) || empty($pst['disch_st']) || $pst['disch_st'] == '0') {
			$disch_st = "-";
		} else {
			$disch_st = $status['disch_st'][$pst['disch_st']];
		}

		$disch_st_opt = "";
		foreach ($status['disch_st'] as $key => $val) {
			$disch_st_opt .= "<option value=\"".$key."\">".$val."</option>";
		}

		$user_role = Session::get('user_role');
		/* check pt_status for disible select */
		switch ($user_role) {
			case 'root':
				$pt_status_disabled = NULL;
				$warning_pt_status_text = NULL;
				break;
			default:
				if ($pst['pt_status'] == 2) {
					$pt_status_disabled = 'disabled';
					$warning_pt_status_text = 'Confirmed ไม่สามารถเปลี่ยนสถานะได้แล้ว';
				} else {
					$pt_status_disabled = NULL;
					$warning_pt_status_text = NULL;
				}
				break;
		}

		/* check role for allow change news_st status and disible select */
		if ($user_role == 'root' || $user_role == 'ddc') {
			$news_st_disabled = NULL;
			$warning_news_st_text = NULL;
		} else {
			$news_st_disabled = 'disabled';
			$warning_news_st_text = 'เปลี่ยนสถานะได้เฉพาะผู้ได้รับมอบหมายเท่านั้น';
		}

		return "
		<div class=\"modal-header\">
			<h5 class=\"modal-title\" id=\"statusModalLabel".$pst['id']."\"><i class=\" fas fa-check-circle\"></i> เปลี่ยนสถานะ ID: ".$pst['id']."</h5>
			<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">
				<span aria-hidden=\"true\">&times;</span>
			</button>
		</div>
		<div class=\"modal-body\">
			<div class=\"form-row\">
				<div class=\"col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12\">
					<div class=\"form-group\">
						<label for=\"patient\" class=\"text-danger font-16\">สถานะ <span class=\"badge badge-pill badge-danger\">".$warning_pt_status_text."</label>
						<input type=\"hidden\" name=\"id\" value=\"".$pst['id']."\">
						<select name=\"pt_status\" class=\"form-control selectpicker show-tick\" id=\"pt_status".$pst['id']."\" ".$pt_status_disabled.">
							<option value=\"".$pst['pt_status']."\" selected=\"selected\">".$pt_status."</option>
							<option value=\"\">-- โปรดเลือก --</option>"
							.$pt_status_opt.
						"</select>
						<input type=\"hidden\" name=\"pt_status_hidden\" value=\"".$pst['pt_status']."\">
					</div>
				</div>
				<div class=\"col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12\">
					<div class=\"form-group\">
						<label for=\"news\" class=\"text-info font-16\">แถลงข่าว <span class=\"badge badge-pill badge-danger\">".$warning_news_st_text."</label>
						<select name=\"news_status\" class=\"form-control selectpicker show-tick\" id=\"news_st".$pst['id']."\" ".$news_st_disabled.">
							<option value=\"".$pst['news_st']."\" selected=\"selected>\">".$news_st."</option>
							<option value=\"\">-- โปรดเลือก --</option>"
							.$news_st_opt.
						"</select>
						<input type=\"hidden\" name=\"news_st_hidden\" value=\"".$pst['news_st']."\">
					</div>
				</div>
				<div class=\"col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12\">
					<div class=\"form-group\">
						<label for=\"discharge font-16\" class=\"text-success\">Discharge</label>
						<select name=\"disch_st\" class=\"form-control selectpicker show-tick\" id=\"disch_st".$pst['id']."\">
							<option value=\"".$pst['disch_st']."\" selected=\"selected\">".$disch_st."</option>
							<option value=\"\">-- โปรดเลือก --</option>"
							.$disch_st_opt.
						"</select>
					</div>
				</div>
			</div>
		</div>
		<div class=\"modal-footer\">
			<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">ยกเลิก</button>
			<input type=\"submit\" class=\"btn btn-danger\" value=\"เปลี่ยนทันที\">
		</div>
		<script>
			$(document).ready(function() {
				$('.selectpicker').selectpicker();
			});
		</script>";
	}

	public function referOut(Request $request) {
		/* get hospital data */
		$pst = InvestList::select('id', 'treat_place_hospital')->where('id', '=', $request->id)->first();
		if (is_null($pst->treat_place_hospital)) {
			$cur_hosp_str = 'ยังไม่มีข้อมูล';
		} else {
			$hosp = Hospitals::select('hospcode', 'hosp_name')->where('hospcode', '=', $pst->treat_place_hospital)->first();
			if (!is_null($hosp)) {
				$cur_hosp_str = $hosp->hosp_name;
			} else {
				$cur_hosp_str = 'ไม่พบข้อมูลโรงพยาบาลรหัส: '.$pst->treat_place_hospital;
			}
		}

		/* get provinces */
		$provinces = Provinces::select('province_id', 'province_name')->orderBy('province_name', 'ASC')->get();
		$prov_list = "";
		$provinces->each(function($item, $key) use (&$prov_list) {
			$prov_list .= "<option value=\"".$item->province_id."\">".$item->province_name."</option>";
		});
		return "
		<div class=\"modal-header\">
			<h5 class=\"modal-title text-danger\"><i class=\"fas fa-ambulance\"></i> ส่งต่อผู้ป่วยรหัส: <span class=\"text-info\">".$request->id."</span></h5>
			<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">
				<span aria-hidden=\"true\">&times;</span>
			</button>
		</div>
		<div class=\"modal-body\">
				<div class=\"form-row\">
					<div class=\"col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12\">
						<div class=\"alert alert-warning\">โรงพยาบาลที่รักษาปัจจุบัน: <span class=\"text-info\">".$cur_hosp_str."</span></div>
						<input type=\"hidden\" name=\"refer_pid\" value=\"".$request->id."\">
					</div>
					<div class=\"col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12\">
						<div class=\"form-group\">
							<label for=\"province\" class=\"font-16\">เลือกจังหวัด</label>
							<select name=\"refer_province\" class=\"form-control selectpicker show-tick\" id=\"refer_province\">
								<option value=\"\">-- โปรดเลือก --</option>"
								.$prov_list.
							"</select>
						</div>
					</div>
					<div class=\"col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12\">
						<div class=\"form-group\">
							<label for=\"district\" class=\"font-16\">เลือกอำเภอ</label>
							<select name=\"refer_district\" class=\"form-control selectpicker show-tick\" id=\"refer_district\">
								<option value=\"\">-- โปรดเลือก --</option>
							</select>
						</div>
					</div>
					<div class=\"col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12\">
						<div class=\"form-group\">
							<label for=\"subDistrict\" class=\"font-16\">เลือกตำบล</label>
							<select name=\"refer_sub_district\" class=\"form-control selectpicker show-tick\" id=\"refer_sub_district\">
								<option value=\"\">-- โปรดเลือก --</option>
							</select>
						</div>
					</div>
					<div class=\"col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12\">
						<div class=\"form-group\">
							<label for=\"hospital\" class=\"text-primary font-16\">เลือกโรงพยาบาลที่ต้องการส่งต่อ</label>
							<select name=\"refer_hospital\" class=\"form-control selectpicker show-tick\" data-style=\"btn btn-primary\" data-live-search=\"true\" id=\"refer_hospital\">
								<option value=\"\">-- โปรดเลือก --</option>
							</select>
						</div>
					</div>
				</div>
		</div>
		<div class=\"modal-footer\">
			<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">ยกเลิก</button>
			<input type=\"submit\" class=\"btn btn-danger\" value=\"ส่งต่อผู้ป่วย\">
		</div>
		<script>
			$(document).ready(function() {
				$('.selectpicker').selectpicker();
				$('#refer_province').change(function() {
					if ($(this).val() != '') {
						var id = $(this).val();
						$.ajax({
							method: 'POST',
							url: '".route('districtFetch')."',
							dataType: 'HTML',
							data: {id:id},
							success: function(response) {
								$('#refer_district').html(response);
								$('#refer_district').selectpicker('refresh');
							},
							error: function(jqXhr, textStatus, errorMessage){
								alert('Error code: ' + jqXhr.status + errorMessage);
							}
						});
					}
				});
				$('#refer_district').change(function() {
					if ($(this).val() != '') {
						var id = $(this).val();
						var prov_id = $('#refer_province').val();
						$.ajax({
							method: 'POST',
							url: '".route('subDistrictFetch')."',
							dataType: 'HTML',
							data: {id:id},
							success: function(response) {
								$('#refer_sub_district').html(response);
								$('#refer_sub_district').selectpicker('refresh');
								$.ajax({
									method: 'POST',
									url: '".route('hospitalFetchByDistrict2Digit')."',
									dataType: 'HTML',
									data: {prov_id:prov_id, dist_id:id},
									success: function(hosp) {
										$('#refer_hospital').html(hosp);
										$('#refer_hospital').selectpicker('refresh');

									}
								});
							},
							error: function(jqXhr, textStatus, errorMessage){
								alert('Error code: ' + jqXhr.status + errorMessage);
							}
						});
					}
				});
			});
		</script>";
	}

	public function colabSend(Request $request) {
		try {
			$data = InvestList::select('id', 'sat_id', 'card_id', 'passport', 'hn', 'mobile', 'pt_status')->where('id', '=', $request->id)->get();
			$firstname = self::addHyphen(auth()->user()->name);
			$lastname = self::addHyphen(auth()->user()->lname);
			$email = self::addHyphen(auth()->user()->email);
			$userMobile = self::addHyphen(auth()->user()->tel);
			$patientHN =  self::addHyphen($data[0]->hn);
			$patientSatCode = self::addHyphen($data[0]->sat_id);
			$patientCID = self::addHyphen($data[0]->card_id);
			$patientPassport = self::addHyphen($data[0]->passport);
			$patientMobile = self::addHyphen($data[0]->mobile);
			$hospcode = self::addHyphen(auth()->user()->hospcode);
			//$send_url = Helper::url_query('https://apiservice.ddc.moph.go.th/ddc-ilab/Send-CoLab', [
			$send_url = Helper::url_query('https://co-lab.moph.go.th/COLAB/Callback.aspx', [
			//$send_url = Helper::url_query('https://apps.boe.moph.go.th/test/pj.php', [
				'UserName'=> auth()->user()->username,
				'FirstName' => $firstname,
				'LastName' => $lastname,
				'Email' => $email,
				'UserMobile' => $userMobile,
				'UserPosition' => '-',
				'ScreenType' => 'detail',
				'DDCPatientID' => $data[0]->id,
				'PatientDDCType' => '1',
				'PatientHN' =>  $patientHN,
				'PatientSatCode' => $patientSatCode,
				'PatientCID' => $patientCID,
				'PatientPassport' => $patientPassport,
				'PatientMobile' => $patientMobile,
				'HospitalCode' => $hospcode
			]);

			/* log to sent */
			if (count($data) > 0) {
				$today = date('Y-m-d H:i:s');
				DB::table('log_colab')->insert([
					'ref_pt_id' => $request->id,
					'sat_id' => $data[0]->sat_id,
					'send_method' => 'GET',
					'send_url' => $send_url,
					'send_date' => $today,
					'ref_user_id' => Auth::user()->id,
					'created_at' => $today
				]);

				/* update invest pt after sent */
				$inv = InvestList::find($request->id);
				$inv->colab_send = 'Y';
				$inv->save();

				/* write to log msg */
				Log::notice('User: '.Auth::user()->id.' sent patient id '.$request->id.' to COLAB');
			} else {
				$send_url = 0;
			}
			return redirect($send_url);
		} catch(\Exception $e) {
			Log::error(sprintf("%s - line %d - ", __FILE__, __LINE__).$e->getMessage());
		}
	}

	public function colabResult(Request $request) {
		try {
			$data = InvestList::select('id', 'sat_id', 'card_id', 'passport', 'hn', 'mobile', 'pt_status')->where('id', '=', $request->id)->get();
			$firstname = self::addHyphen(auth()->user()->name);
			$lastname = self::addHyphen(auth()->user()->lname);
			$email = self::addHyphen(auth()->user()->email);
			$userMobile = self::addHyphen(auth()->user()->tel);
			$patientHN =  self::addHyphen($data[0]->hn);
			$patientSatCode = self::addHyphen($data[0]->sat_id);
			$patientCID = self::addHyphen($data[0]->card_id);
			$patientPassport = self::addHyphen($data[0]->passport);
			$patientMobile = self::addHyphen($data[0]->mobile);
			$hospcode = self::addHyphen(auth()->user()->hospcode);
			//$send_url = Helper::url_query('https://apiservice.ddc.moph.go.th/ddc-ilab/Send-CoLab', [
			$send_url = Helper::url_query('https://co-lab.moph.go.th/COLAB/Callback.aspx', [
			//$send_url = Helper::url_query('https://apps.boe.moph.go.th/test/pj.php', [
				'UserName'=> auth()->user()->username,
				'FirstName' => $firstname,
				'LastName' => $lastname,
				'Email' => $email,
				'UserMobile' => $userMobile,
				'UserPosition' => '-',
				'ScreenType' => 'query',
				'DDCPatientID' => $data[0]->id,
				'PatientDDCType' => '1',
				'PatientHN' =>  $patientHN,
				'PatientSatCode' => $patientSatCode,
				'PatientCID' => $patientCID,
				'PatientPassport' => $patientPassport,
				'PatientMobile' => $patientMobile,
				'HospitalCode' => $hospcode
			]);
			return redirect($send_url);
		} catch(\Exception $e) {
			Log::error(sprintf("%s - line %d - ", __FILE__, __LINE__).$e->getMessage());
		}
	}

	private function addHyphen($str) {
		if (empty($str) || is_null($str) || (strlen($str) <= 0) || $str == "") {
			$str = "-";
		}
		return $str;
	}

}

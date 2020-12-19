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
use App\CriterionFail;
use App\Http\Controllers\MasterController;
use App\Exports\InvestExport;
use Maatwebsite\Excel\Facades\Excel;
use Session, Helper, DB, Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Redirect;

class ListInvestController extends Controller
{
	public function __construct() {
		$this->middleware('auth');
		$this->middleware('onlyOneUser');
		$this->middleware(['role:root|ddc|dpc|pho|hos']);
	}

	/*public function index(ListInvestDataTable $dataTable) {
		return $dataTable->render('list-data.invest');
	}*/
	public function index() {
		return redirect()->route('testConn');
	}

	public function export() {
		return Excel::download(new InvestExport, 'invest.csv');
	}

	public function exportByParams($id = 56) {
		return Excel::download(new InvestExport($id), 'invest.xlsx');
	}

	public function softDeleteInvest(Request $request) {
		try {
			$user = auth()->user();
			if ($user->hasPermissionTo('pui-delete')) {
				/* check inv_id on trigger_lab _result_log table have or not  */
				$inv_id_trigger = DB::table('trigger_lab_result_log')->select('id_trig')->where('inv_id', '=', $request->pid)->get()->toArray();
				if (count($inv_id_trigger) == 0) {
					$user_role = Session::get('user_role');
					$dt = Carbon::today();
					$start_date = $dt->sub('3 days')->toDateString();
					$start_date = $start_date." 00:00:00";
					$end_date = date('Y-m-d H:i:s');

					/* select data for prepare to update criterionfail tbl */
					$inv = InvestList::select('id', 'sat_id', DB::raw('DATE(created_at) AS inv_date_create'))->where('id', $request->pid)->get()->toArray();
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
						$date_now = date('Y-m-d H:i:s');
						$ct = DB::table("criterion_fail")
							->where("sat_id", $inv[0]['sat_id'])
							->whereDate('date_create', '=', $inv[0]['inv_date_create'])
							->update(["delete_at" => $date_now]);
						Log::notice('User:'.$user->id.' Deleted PID: '.$request->pid);
						return redirect()->back()->with('success', 'ข้อมูลรหัสที่ '.$request->pid.' ถูกลบออกจากระบบแล้ว');
					} else {
						return redirect()->back()->with('error', 'ข้อมูลรหัสที่ '.$request->pid.' ไม่สามารถลบออกจากระบบได้ โปรดตรวจสอบเงื่อนไข');
					}
				} else {
					return redirect()->back()->with('error', 'ข้อมูลรหัสที่ '.$request->pid.' ไม่สามารถลบออกจากระบบได้ เนื่องจากมีข้อมูลตัวอย่างส่งตรวจแล้ว');
				}
			} else {
				return redirect()->back()->with('error', 'ท่านไม่มีสิทธิ์ลบข้อมูล !!');
			}
		} catch (Exception $e) {
			Log::error($e->getMessage());
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

	public function chPtStatus(Request $request) {
		$pst = InvestList::select('id', 'sat_id', 'pt_status', 'type_nature')->where('id', '=', $request->id)->first();

		$master = new MasterController;
		$status = $master->getStatus();

		if (is_null($pst['pt_status']) || empty($pst['pt_status']) || $pst['pt_status'] == '0') {
			$pt_status = null;
		} else {
			$pt_status = $status['pt_status'][$pst['pt_status']];
		}

		/* continue status key 3 & 4 */
		$pt_status_opt = "";
		foreach ($status['pt_status'] as $key => $val) {
			if ($key == '3' || $key =='4') {
				continue;
			} else {
				$pt_status_opt .= "<option value=\"".$key."\">".$val."</option>";
			}
		}

		/* type nature */
		$ref_type_nature = $status['type_nature'];
		if (is_null($pst['type_nature']) || empty($pst['type_nature']) || $pst['type_nature'] == '0') {
			$type_nature = null;
		} else {
			$type_nature = "<option value=\"".$pst['type_nature']."\">".$ref_type_nature[$pst['type_nature']]."</option>";
		}

		$type_nature_opt = "";
		foreach ($ref_type_nature as $key => $val) {
			$type_nature_opt .= "<option value=\"".$key."\">".$val."</option>";
		}

		/* check pt_status for disible select */
		$user_role = Session::get('user_role');
		switch ($user_role) {
			case 'root':
				$pt_status_disabled = null;
				$warning_pt_status_text = null;
				break;
			default:
				if ($pst['pt_status'] == '2') {
					$pt_status_disabled = 'disabled';
					$warning_pt_status_text = 'Confirmed ไม่สามารถเปลี่ยนสถานะได้แล้ว';
				} else {
					$pt_status_disabled = null;
					$warning_pt_status_text = null;
				}
				break;
		}

		$htm = "
		<div class=\"modal-header\">
			<h5 class=\"modal-title text-color-custom-6\" id=\"statusModalLabel".$pst['id']."\"><i class=\" fas fa-check-circle\"></i> เปลี่ยนสถานะผู้ป่วย รหัส: ".$pst['id']."</h5>
			<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">
				<span aria-hidden=\"true\">&times;</span>
			</button>
		</div>
		<div class=\"modal-body\">
			<div class=\"form-row\">
				<div class=\"col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12\">
					<div class=\"form-group\">
						<label for=\"patient\" class=\"text-info font-16\">สถานะผู้ป่วย <span class=\"badge badge-pill badge-danger\">".$warning_pt_status_text."</label>
						<input type=\"hidden\" name=\"id\" value=\"".$pst['id']."\">
						<select name=\"pt_status\" class=\"form-control selectpicker show-tick\" id=\"pt_status".$pst['id']."\" ".$pt_status_disabled.">";
							if (!is_null($pt_status)) {
								$htm .= "<option value=\"".$pst['pt_status']."\" selected=\"selected\">".$pt_status."</option>";
							}
						$htm .= "
							<option value=\"0\">-- โปรดเลือก --</option>"
							.$pt_status_opt.
						"</select>
						<input type=\"hidden\" name=\"pt_status_hidden\" value=\"".$pst['pt_status']."\">
					</div>
				</div>
				<div class=\"col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12\">
					<div class=\"form-group\">
						<label for=\"patientType\" class=\"text-info font-16\">ประเภทผู้ป่วย</label>
						<select name=\"pt_type\" class=\"form-control show-tick pt_type\" id=\"pt_type".$pst['id']."\">"
							.$type_nature.
							"<option value=\"0\">โปรดเลือก</option>"
							.$type_nature_opt.
						"</select>
					</div>
				</div>
			</div>
		</div>
		<div class=\"modal-footer\">
			<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">ยกเลิก</button>
			<input type=\"submit\" class=\"btn btn-custom-3\" value=\"เปลี่ยนทันที\">
		</div>
		<script>
			$(document).ready(function() {
				$('.selectpicker').selectpicker();
				$('.pt_type').selectpicker();
				/*
				$('#pt_status".$pst['id']."').on('change', function() {
					var pst_id = $('#pt_status".$pst['id']."').val();
					if (pst_id == '2') {
						$('.pt_type').prop('disabled', false).selectpicker('refresh');
					} else {
						$('.pt_type').prop('disabled', true).selectpicker('refresh');
					}
				});
				*/
			});
		</script>";
		return $htm;
	}

	public function chNewsStatus(Request $request) {
		$pst = InvestList::select('id', 'sat_id', 'news_st', 'order_pt', 'news_dt')->where('id', '=', $request->id)->first();

		$master = new MasterController;
		$status = $master->getStatus();

		if (is_null($pst['news_st']) || empty($pst['news_st']) || $pst['news_st'] == '0') {
			$news_st = null;
		} else {
			$news_st = $status['news_st'][$pst['news_st']];
		}

		$news_st_opt = "";
		foreach ($status['news_st'] as $key => $val) {
			$news_st_opt .= "<option value=\"".$key."\">".$val."</option>";
		}

		if (is_null($pst['news_dt']) || empty($pst['news_dt'])) {
			$news_dt = null;
		} else {
			$news_dt = self::convertMySQLDateFormat($pst['news_dt']);
		}

		$user_role = Session::get('user_role');
		if ($user_role == 'root' || $user_role == 'ddc') {
			$news_st_disabled = null;
			$warning_news_st_text = null;
		} else {
			$news_st_disabled = 'disabled';
			$warning_news_st_text = 'เปลี่ยนสถานะได้เฉพาะผู้ได้รับมอบหมายเท่านั้น';
		}

		$htm = "
		<div class=\"modal-header\">
			<h5 class=\"modal-title text-color-custom-6\" id=\"statusModalLabel".$pst['id']."\"><i class=\" fas fa-check-circle\"></i> เปลี่ยนสถานะการแถลงข่าว รหัส: ".$pst['id']."</h5>
			<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">
				<span aria-hidden=\"true\">&times;</span>
			</button>
		</div>
		<div class=\"modal-body\">
			<div class=\"form-row\">
				<div class=\"col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12\">
					<div class=\"form-group\">
						<label for=\"news\" class=\"text-info font-16\">สถานะการแถลงข่าว <span class=\"badge badge-pill badge-danger\">".$warning_news_st_text."</label>
						<input type=\"hidden\" name=\"id\" value=\"".$pst['id']."\">
						<select name=\"news_status\" class=\"form-control selectpicker show-tick\" id=\"news_st".$pst['id']."\" ".$news_st_disabled.">";
						if (!is_null($news_st)) {
							$htm .= "<option value=\"".$pst['news_st']."\" selected=\"selected>\">".$news_st."</option>";
						}
						$htm .= "
							<option value=\"\">-- โปรดเลือก --</option>"
							.$news_st_opt.
						"</select>
					</div>
				</div>
				<div class=\"col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12\">
					<div class=\"form-group\">
						<label for=\"orderNo\" class=\"text-info font-16\">ลำดับที่ประกาศข่าว <span class=\"badge badge-warning badge-pill\">เฉพาะผลแลปยืนยัน</span></label>
						<input type=\"number\" name=\"orderNo\" class=\"form-control order-no\" id=\"order_no".$pst['id']."\" min=\"1\" value=\"".$pst['order_pt']."\" disabled>
					</div>
				</div>
				<div class=\"col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12\">
					<div class=\"form-group\">
						<label for=\"orderDate\" class=\"text-info font-16\">วันที่ประกาศข่าว <span class=\"badge badge-warning badge-pill\">เฉพาะผลแลปยืนยัน</span></label>
						<div class=\"input-group\">
							<div class=\"input-group-append\">
								<span class=\"input-group-text\"><i class=\"mdi mdi-calendar\"></i></span>
							</div>
							<input type=\"text\" name=\"orderDate\" data-provide=\"datepicker\" class=\"form-control order-date\" id=\"order_date\" value=\"".$news_dt."\" readonly disabled>
							<div class=\"input-group-append\">
								<button type=\"button\" class=\"input-group-text text-danger\" id=\"cls_order_date\"><i class=\"fas fa-times\"></i></button>
							</div>
						</div>
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
				$('#cls_order_date').click(function() {
					$('#order_date').val('');
				});
				$('#order_date').datepicker({
					format: 'dd/mm/yyyy',
					todayHighlight: true,
					todayBtn: true,
					autoclose: true
				});

				$('#news_st".$pst['id']."').on('change', function() {
					let news_id = $('#news_st".$pst['id']."').val();
					if (news_id == '1') {
						$('.order-no').prop('disabled', false).selectpicker('refresh');
						$('.order-date').prop('disabled', false);
					} else {
						$('#order_no".$pst['id']."').val('');
						$('#order_date').val('');
						$('.order-no').prop('disabled', true).selectpicker('refresh');
						$('.order-date').prop('disabled', true);
					}
				});
			});
		</script>";
		return $htm;
	}

	public function chDcStatus(Request $request) {
		$pst = InvestList::select('id', 'sat_id', 'disch_st')->where('id', '=', $request->id)->first();
		$master = new MasterController;
		$status = $master->getStatus();

		if (is_null($pst['disch_st']) || empty($pst['disch_st']) || $pst['disch_st'] == '0') {
			$disch_st = null;
		} else {
			$disch_st = $status['disch_st'][$pst['disch_st']];
		}

		$disch_st_opt = "";
		foreach ($status['disch_st'] as $key => $val) {
			$disch_st_opt .= "<option value=\"".$key."\">".$val."</option>";
		}

		$htm = "
		<div class=\"modal-header\">
			<h5 class=\"modal-title text-color-custom-6\" id=\"statusModalLabel".$pst['id']."\"><i class=\" fas fa-check-circle\"></i> เปลี่ยนสถานะ รหัส: ".$pst['id']."</h5>
			<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">
				<span aria-hidden=\"true\">&times;</span>
			</button>
		</div>
		<div class=\"modal-body\">
			<div class=\"form-row\">
				<div class=\"col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12\">
					<div class=\"form-group\">
						<label for=\"discharge font-16\" class=\"text-info\">Discharge</label>
						<input type=\"hidden\" name=\"id\" value=\"".$pst['id']."\">
						<select name=\"disch_st\" class=\"form-control selectpicker show-tick\" id=\"disch_st".$pst['id']."\">";
							if (!is_null($disch_st)) {
								$htm .= "<option value=\"".$pst['disch_st']."\" selected=\"selected\">".$disch_st."</option>";
							}
							$htm .= "<option value=\"\">-- โปรดเลือก --</option>"
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
	return $htm;
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
			$username = self::addHyphen(auth()->user()->username);
			$firstname = self::addHyphen(auth()->user()->name);
			$lastname = self::addHyphen(auth()->user()->lname);
			$email = self::addHyphen(auth()->user()->email);
			$userMobile = self::addHyphen(auth()->user()->tel);
			$userPosition = self::addHyphen(auth()->user()->position);
			$screenType = 'detail'; // for send
			$ddcPatientId = $data[0]->id;
			$patientDDCType = '1';
			$patientHN =  self::addHyphen($data[0]->hn);
			$patientSatCode = self::addHyphen($data[0]->sat_id);
			$patientCID = self::addHyphen($data[0]->card_id);
			$patientPassport = self::addHyphen($data[0]->passport);
			$patientMobile = self::addHyphen($data[0]->mobile);
			$hospcode = self::addHyphen(auth()->user()->hospcode);
			$data = json_encode([
				'UserName'=> $username,
				'FirstName' => $firstname,
				'LastName' => $lastname,
				'Email' => $email,
				'UserMobile' => $userMobile,
				'UserPosition' => $userPosition,
				'ScreenType' => $screenType,
				'DDCPatientID' => $ddcPatientId,
				'PatientDDCType' => $patientDDCType,
				'PatientHN' =>  $patientHN,
				'PatientSatCode' => $patientSatCode,
				'PatientCID' => $patientCID,
				'PatientPassport' => $patientPassport,
				'PatientMobile' => $patientMobile,
				'HospitalCode' => $hospcode
			]);

			$client = new \GuzzleHttp\Client([
				'headers' => ['Content-Type' => 'application/json'],
				'verify' => false
			]);

			$response = $client->post('https://apiservice.ddc.moph.go.th/ddc-ilab/api/v1/Colab/PostLabData', ['body' => $data]);
			$response = json_decode($response->getBody(), true);
			if ($response) {
				if ($response['ResultCode'] == '20000' && $response['DeveloperMessage'] == 'Success') {
					/* log to db */
					$today = date('Y-m-d H:i:s');
					DB::table('log_colab')->insert([
						'ref_pt_id' => $request->id,
						'sat_id' => $ddcPatientId,
						'send_method' => 'API',
						'send_url' => 'https://apiservice.ddc.moph.go.th/ddc-ilab/api/v1/Colab/PostLabData',
						'send_date' => $today,
						'ref_user_id' => Auth::user()->id,
						'created_at' => $today
					]);
					/* update invest pt after sent */
					$inv = InvestList::find($request->id);
					$inv->colab_send = 'Y';
					$inv->save();
					/* write to log msg */
					Log::notice('ผู้ใช้: '.Auth::user()->id.' ส่งข้อมูลรหัสที่ '.$request->id.' ไปยัง COLAB');
					/* redirect to colab url */
					self::redirectToUrl($response['RedirectUri']);
				} else {
					return redirect()->back()->with('error', 'ข้อมูลรหัสที่ '.$request->id.' ไม่สามารถส่งไปยังระบบ COLAB ได้');
				}
			} else {
				return redirect()->back()->with('error', 'ระบบ COLAB ไม่ตอบสนอง โปรดตรวจสอบ');
			}
		} catch(\Exception $e) {
			Log::error(sprintf("%s - line %d - ", __FILE__, __LINE__).$e->getMessage());
		}
	}

	public function colabResult(Request $request) {
		try {
			$data = InvestList::select('id', 'sat_id', 'card_id', 'passport', 'hn', 'mobile', 'pt_status')->where('id', '=', $request->id)->get();
			$username = self::addHyphen(auth()->user()->username);
			$firstname = self::addHyphen(auth()->user()->name);
			$lastname = self::addHyphen(auth()->user()->lname);
			$email = self::addHyphen(auth()->user()->email);
			$userMobile = self::addHyphen(auth()->user()->tel);
			$userPosition = self::addHyphen(auth()->user()->position);
			$screenType = 'detail'; // for send
			$ddcPatientId = $data[0]->id;
			$patientDDCType = '1';
			$patientHN =  self::addHyphen($data[0]->hn);
			$patientSatCode = self::addHyphen($data[0]->sat_id);
			$patientCID = self::addHyphen($data[0]->card_id);
			$patientPassport = self::addHyphen($data[0]->passport);
			$patientMobile = self::addHyphen($data[0]->mobile);
			$hospcode = self::addHyphen(auth()->user()->hospcode);
			$data = json_encode([
				'UserName'=> $username,
				'FirstName' => $firstname,
				'LastName' => $lastname,
				'Email' => $email,
				'UserMobile' => $userMobile,
				'UserPosition' => $userPosition,
				'ScreenType' => $screenType,
				'DDCPatientID' => $ddcPatientId,
				'PatientDDCType' => $patientDDCType,
				'PatientHN' =>  $patientHN,
				'PatientSatCode' => $patientSatCode,
				'PatientCID' => $patientCID,
				'PatientPassport' => $patientPassport,
				'PatientMobile' => $patientMobile,
				'HospitalCode' => $hospcode
			]);
			$client = new \GuzzleHttp\Client([
				'headers' => ['Content-Type' => 'application/json'],
				'verify' => false
			]);

			$response = $client->post('https://apiservice.ddc.moph.go.th/ddc-ilab/api/v1/Colab/ViewLabData', ['body' => $data]);
			$response = json_decode($response->getBody(), true);
			if ($response) {
				if ($response['ResultCode'] == '20000' && $response['DeveloperMessage'] == 'Success') {
					/* write to log msg */
					Log::notice('ผู้ใช้: '.Auth::user()->id.' เรียกดูข้อมูลรหัส '.$request->id.' จากระบบ COLAB');
					self::redirectToUrl($response['RedirectUri']);
				} else {
					return redirect()->back()->with('error', 'ข้อมูลรหัสที่ '.$request->id.' ไม่สามารถเรียกดูจากระบบ COLAB');
				}
			} else {
				return redirect()->back()->with('error', 'ระบบ COLAB ไม่ตอบสนอง โปรดตรวจสอบ');
			}
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

	private function convertMySQLDateFormat($date='0000-00-00', $seperator="/") {
		if (!is_null($date) || !empty($date)) {
			$ep = explode("-", $date);
			$string = $ep[2].$seperator.$ep[1].$seperator.$ep[0];
		} else {
			$string = null;
		}
		return $string;
	}

	protected function redirectToUrl($url) {
		echo "<script>window.location.replace('".$url."');</script>";
	}

}

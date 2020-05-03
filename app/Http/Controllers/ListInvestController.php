<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\ListInvestDataTable;
use App\InvestList;
use App\Http\Controllers\MasterController;
use App\Exports\InvestExport;
use Maatwebsite\Excel\Facades\Excel;
use Session;

class ListInvestController extends Controller
{
	public function __construct() {
		$this->middleware('auth');
		//$this->middleware('chkUserRole');
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
		$pt = InvestList::destroy($request->pid);
		if ($pt == 1) {
			return redirect()->back()->with('success', 'ข้อมูลรหัสที่ '.$request->pid.' ถูกลบออกจากระบบแล้ว');
		} else {
			return redirect()->back()->with('error', 'ข้อมูลรหัสที่ '.$request->pid.' ไม่สามารถลบออกจากระบบได้');
		}

	}

	public function chStatus(Request $request) {
		$pst = InvestList::select('id', 'sat_id', 'pt_status', 'news_st', 'disch_st')
			->where('id', '=', $request->id)
			->first();
		$master = new MasterController;
		$status = $master->getStatus();

		/* pt status */
		$pt_status = (!empty($pst['pt_status'])) ? $status['pt_status'][$pst['pt_status']] : "-";
		$pt_status_opt = "";
		foreach ($status['pt_status'] as $key => $val) {
			if ($key == '3' || $key =='4') {
				continue;
			} else {
				$pt_status_opt .= "<option value=\"".$key."\">".$val."</option>";
			}
		}

		/* news status */
		$news_st = (!empty($pst['news_st'])) ? $status['news_st'][$pst['news_st']] : "-";
		$news_st_opt = "";
		foreach ($status['news_st'] as $key => $val) {
			$news_st_opt .= "<option value=\"".$key."\">".$val."</option>";
		}

		/* dischart status */
		$disch_st = (!empty($pst['disch_st'])) ? $status['disch_st'][$pst['disch_st']] : "-";
		$disch_st_opt = "";
		foreach ($status['disch_st'] as $key => $val) {
			$disch_st_opt .= "<option value=\"".$key."\">".$val."</option>";
		}

		/* check pt_status for disible select */
		if ($pst['pt_status'] == 2) {
			$pt_status_disabled = 'disabled';
			$warning_pt_status_text = 'Confirmed ไม่สามารถเปลี่ยนสถานะได้แล้ว';
		} else {
			$pt_status_disabled = NULL;
			$warning_pt_status_text = NULL;
		}

		/* check role for allow change news_st status and disible select */
		$user_role = Session::get('user_role');
		if ($user_role == 'root' || $user_role == 'ddc') {
			$news_st_disabled = NULL;
			$warning_news_st_text = NULL;
		} else {
			$news_st_disabled = 'disabled';
			$warning_news_st_text = 'เปลี่ยนสถานะได้เฉพาะผู้ได้รับมอบหมายเท่านั้น';
		}


		return "
		<div class=\"modal-header\">
			<h5 class=\"modal-title\" id=\"statusModalLabel".$pst['id']."\">เปลี่ยนสถานะ ID: ".$pst['id']."</h5>
			<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">
				<span aria-hidden=\"true\">&times;</span>
			</button>
		</div>
		<div class=\"modal-body\">
			<div class=\"form-row\">
				<div class=\"col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12\">
					<div class=\"form-group\">
						<label for=\"patient\">สถานะ <span class=\"badge badge-pill badge-danger\">".$warning_pt_status_text."</label>
						<input type=\"hidden\" name=\"id\" value=\"".$pst['id']."\">
						<select name=\"pt_status\" class=\"form-control selectpicker\" id=\"pt_status".$pst['id']."\" ".$pt_status_disabled.">
							<option value=\"".$pst['pt_status']."\" selected=\"selected\">".$pt_status."</option>
							<option value=\"\">-- โปรดเลือก --</option>"
							.$pt_status_opt.
						"</select>
						<input type=\"hidden\" name=\"pt_status_hidden\" value=\"".$pst['pt_status']."\">
					</div>
				</div>
				<div class=\"col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12\">
					<div class=\"form-group\">
						<label for=\"news\">แถลงข่าว <span class=\"badge badge-pill badge-danger\">".$warning_news_st_text."</label>
						<select name=\"news_status\" class=\"form-control\" id=\"news_st".$pst['id']."\" ".$news_st_disabled.">
							<option value=\"".$pst['news_st']."\" selected=\"selected>\">".$news_st."</option>
							<option value=\"\">-- โปรดเลือก --</option>"
							.$news_st_opt.
						"</select>
						<input type=\"hidden\" name=\"news_st_hidden\" value=\"".$pst['news_st']."\">
					</div>
				</div>
				<div class=\"col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12\">
					<div class=\"form-group\">
						<label for=\"discharge\">Discharge</label>
						<select name=\"disch_st\" class=\"form-control\" id=\"disch_st".$pst['id']."\">
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
		</div>";
	}
}

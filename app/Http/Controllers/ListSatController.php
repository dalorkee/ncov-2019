<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\ListSatDataTable;
use App\InvestList;
use App\Http\Controllers\MasterController;

class ListSatController extends Controller
{
	public function __construct() {
		$this->middleware('auth');
		$this->middleware(['role:root|ddc']);
	}

	public function index(ListSatDataTable $dataTable) {
		return $dataTable->render('list-data.sat');
	}

	public function chStatus(Request $request) {
		$pst = InvestList::select('id', 'sat_id', 'pt_status', 'news_st', 'disch_st', 'inv')
			->where('id', '=', $request->id)
			->first();
		$master = new MasterController;
		$status = $master->getStatus();

		$pt_status = (!empty($pst['pt_status'])) ? $status['pt_status'][$pst['pt_status']] : "-";
		$pt_status_opt = "";
		foreach ($status['pt_status'] as $key => $val) {
			if ($key == '3' || $key =='4') {
				continue;
			} else {
				$pt_status_opt .= "<option value=\"".$key."\">".$val."</option>";
			}
		}

		$news_st = (!empty($pst['news_st'])) ? $status['news_st'][$pst['news_st']] : "-";
		$news_st_opt = "";
		foreach ($status['news_st'] as $key => $val) {
			$news_st_opt .= "<option value=\"".$key."\">".$val."</option>";
		}

		$disch_st = (!empty($pst['disch_st'])) ? $status['disch_st'][$pst['disch_st']] : "-";
		$disch_st_opt = "";
		foreach ($status['disch_st'] as $key => $val) {
			$disch_st_opt .= "<option value=\"".$key."\">".$val."</option>";
		}

		return "
		<div class=\"modal-header\">
			<h5 class=\"modal-title\" id=\"statusModalLabel".$pst['id']."\">CH STATUS ID: ".$pst['id']."</h5>
			<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">
				<span aria-hidden=\"true\">&times;</span>
			</button>
		</div>
		<div class=\"modal-body\">
			<div class=\"form-row\">
				<div class=\"col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12\">
					<div class=\"form-group\">
						<label for=\"patient\">Status</label>
						<input type=\"hidden\" name=\"id\" value=\"".$pst['id']."\">
						<select name=\"pt_status\" class=\"form-control\" id=\"pt_status".$pst['id']."\">
							<option value=\"".$pst['pt_status']."\" selected=\"selected\">".$pt_status."</option>
							<option value=\"\">-- โปรดเลือก --</option>"
							.$pt_status_opt.
						"</select>
					</div>
				</div>
				<div class=\"col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12\">
					<div class=\"form-group\">
						<label for=\"news\">News</label>
						<select name=\"news_status\" class=\"form-control\" id=\"news_st".$pst['id']."\">
							<option value=\"".$pst['news_st']."\" selected=\"selected>\">".$news_st."</option>
							<option value=\"\">-- โปรดเลือก --</option>"
							.$news_st_opt.
						"</select>
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
			<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>
			<input type=\"submit\" class=\"btn btn-primary\" value=\"Save changes\">
		</div>";
	}
}

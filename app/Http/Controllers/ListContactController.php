<?php
namespace App\Http\Controllers;
use Session;
use DB;
use Illuminate\Http\Request;
use App\DataTables\ListContactDataTable;
use App\ContactList;
use App\FollowContactLists;
use App\Http\Controllers\MasterController;

class ListContactController extends Controller
{
	public function __construct() {
		$this->middleware('auth');
		$this->middleware('onlyOneUser');
		$this->middleware(['role:root|ddc|dpc|pho|hos']);
	}


	public function index(ListContactDataTable $dataTable) {
		return $dataTable->render('list-data.contact');
	}

	public function chStatus(Request $request) {
		$fucon = FollowContactLists::select(
						'id',
						'walkin_hospital',
						'walkin_province',
						'walkin_district',
						'walkin_subdistrict')
					->where('followup_times','=','0')
					->where('contact_rid', '=', $request->id)
					->first();

		$pst = ContactList::select(
					'id',
					'pui_id',
					'sat_id',
					'contact_id',
					'contact_cid',
					'title_contact',
					'name_contact',
					'mname_contact',
					'lname_contact',
					'sex_contact',
					'age_contact',
					'national_contact',
					'risk_contact',
					'phone_contact',
					'status_followup',
					'pt_status')
			->where('id', '=', $request->id)
			->first();
		// dd($pst);
		$master = new MasterController;
		$status = $master->getStatus();
		$fucon_walkin_hospital= (!empty($fucon['walkin_hospital'])) ? $fucon['walkin_hospital'] : "";
		$fucon_walkin_province= (!empty($fucon['walkin_province'])) ? $fucon['walkin_province'] : "";
		$fucon_walkin_district= (!empty($fucon['walkin_district'])) ? $fucon['walkin_district'] : "";
		$fucon_walkin_subdistrict= (!empty($fucon['walkin_subdistrict'])) ? $fucon['walkin_subdistrict'] : "";

		/* pt status */
		$pt_status = (!empty($pst['pt_status'])) ? $status['pt_status'][$pst['pt_status']] : "-";
		$pt_status_opt = "";
		foreach ($status['pt_status'] as $key => $val) {
			if ($key == '' || $key =='0') {
				continue;
			} else {
				$pt_status_opt .= "<option value=\"".$key."\">".$val."</option>";
			}
		}
		/* status followup*/
		$status_followup = (!empty($pst['status_followup'])) ? $status['status_followup'][$pst['status_followup']] : "-";
		$status_followup_opt = "";
		foreach ($status['status_followup'] as $key => $val) {
			if ($key == '' || $key =='0') {
				continue;
			} else {
				$status_followup_opt .= "<option value=\"".$key."\">".$val."</option>";
			}
		}

		$user_role = Session::get('user_role');
		// dd($pst['pt_status']);
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
		switch ($user_role) {
			case 'root':
				$status_followup_disabled = NULL;
				$warning_status_followup_text = NULL;
				break;
			default:
				if ($pst['pt_status'] == 2) {
					$status_followup_disabled = 'disabled';
					$warning_status_followup_text = 'Confirmed ไม่สามารถเปลี่ยนสถานะการติดตามได้แล้ว';
				} else {
					$status_followup_disabled = NULL;
					$warning_status_followup_text = NULL;
				}
				break;
		}
		switch ($user_role) {
			case 'root':
				$sat_id_disabled = NULL;
				$warning_sat_id_text = NULL;
				break;
			default:
				if ($pst['pt_status'] == 2) {
					$sat_id_disabled = 'disabled';
					$warning_sat_id_text = 'Confirmed ไม่สามารถเปลี่ยนสถานะการติดตามได้แล้ว';

				} else {
					$sat_id_disabled = NULL;
					$warning_sat_id_text = NULL;
				}
				break;
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
				<label for=\"patient\">Contact ID <span class=\"badge badge-pill badge-danger\"></label>
						<input type=\"text\" name=\"sat_id\" oninvalid=\"setCustomValidity('กรุณากรอกข้อมูล Contact ID ')\" class=\"form-control\" value=\"".$pst['contact_id']."\"  required/\" ".$sat_id_disabled.">
					<div class=\"form-group\">
						<label for=\"patient\">สถานะการติดตาม <span class=\"badge badge-pill badge-danger\">".$warning_status_followup_text."</label>
						<input type=\"hidden\" name=\"id\" value=\"".$pst['id']."\">
						<input type=\"hidden\" name=\"contact_id\" value=\"".$pst['contact_id']."\">
						<input type=\"hidden\" name=\"card_id\" value=\"".$pst['contact_cid']."\">
						<input type=\"hidden\" name=\"title_name\" value=\"".$pst['title_contact']."\">
						<input type=\"hidden\" name=\"first_name\" value=\"".$pst['name_contact']."\">
						<input type=\"hidden\" name=\"mid_name\" value=\"".$pst['mname_contact']."\">
						<input type=\"hidden\" name=\"last_name\" value=\"".$pst['lname_contact']."\">
						<input type=\"hidden\" name=\"sex\" value=\"".$pst['sex_contact']."\">
						<input type=\"hidden\" name=\"age\" value=\"".$pst['age_contact']."\">
						<input type=\"hidden\" name=\"nation\" value=\"".$pst['national_contact']."\">
						<input type=\"hidden\" name=\"walkin_hospital\" value=\"".$fucon_walkin_hospital."\">
						<input type=\"hidden\" name=\"walkin_province\" value=\"".$fucon_walkin_province."\">
						<input type=\"hidden\" name=\"walkin_district\" value=\"".$fucon_walkin_district."\">
						<input type=\"hidden\" name=\"walkin_subdistrict\" value=\"".$fucon_walkin_subdistrict."\">
						<select name=\"status_followup\" class=\"form-control selectpicker\" id=\"status_followup".$pst['id']."\" ".$status_followup_disabled.">
							<option value=\"".$pst['status_followup']."\" selected=\"selected\">".$status_followup."</option>
							<option value=\"\">-- โปรดเลือก --</option>"
							.$status_followup_opt.
						"</select>
			</div>
		</div>
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
		<div class=\"modal-footer\">
			<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">ยกเลิก</button>
			<input type=\"submit\" class=\"btn btn-danger\" value=\"เปลี่ยนทันที\" ".$sat_id_disabled.">
		</div>"
		;
	}

}

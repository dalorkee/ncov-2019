<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use DB;

class covidController extends Controller
{
	public function index(Request $request) {
		$eventAgg = $this->eventsAggregate();
		$caseData = $this->getCaseData();
		return view('maps.circle', ['eventAgg'=>$eventAgg, 'caseData'=>$caseData]);
	}

	public function clusters(Request $request) {
		$eventAgg = $this->eventsAggregate();
		$caseData = $this->getCaseData();
		return view('maps.doughnut', ['eventAgg'=>$eventAgg, 'caseData'=>$caseData]);
	}

	protected function getCaseData() {
		$events = DB::table('map_cluster')
			->whereNotNull('lat')
			->whereNotNull('lng')
			->orderBy('cluster_id')
			->get();
		return $events;
	}

	private function eventsAggregate() {
		$totalCase = $this->countEvents();
		$agg['totalCase'] = $totalCase[0]->total_count;
		return $agg;
	}

	/* count all case */
	private function countEvents() {
		$cnt = DB::table('map_cluster')
			->select(DB::raw('count(*) as total_count'))
			->get()
			->toArray();
		return $cnt;
	}

	private function setNowDateRange() {
		$dNow = date('d');
		$mNow = date('m');
		$yNow = date('Y');
		return '01/01/'.$yNow.' - '.$dNow.'/'.$mNow.'/'.$yNow;
	}

	protected function setDateFormat($jsDateRange='d/m/y - d/m/y') {
		$this->str = explode('-', $jsDateRange);
		$dReplace = str_replace('/', '-', $this->str);
		$result = array();
		foreach ($dReplace as $val) {
			$tmp = explode('-', $val);
			$tmp_rs = trim($tmp[2]).'-'.trim($tmp[1]).'-'.trim($tmp[0]);
			array_push($result, $tmp_rs);
		}
		return $result;
	}
}

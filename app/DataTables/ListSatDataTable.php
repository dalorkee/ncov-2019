<?php
namespace App\DataTables;

use App\InvestList;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;
use App\Http\Controllers\MasterController;
use App\GlobalCountry;
use Session;
use DB;

class ListSatDataTable extends DataTable
{
	private function status() {
		$master = new MasterController;
		$status = $master->getStatus();
		return $status;
	}

	private function casePtStatus() {
		$status = $this->status();
		$str = "";
		foreach ($status['pt_status'] as $key => $value) {
			$str .= "WHEN pt_status = \"".$key."\" THEN \"".$value."\" ";
		}
		return $str;
	}

	private function caseNewsSt() {
		$status = $this->status();
		$str = "";
		foreach ($status['news_st'] as $key => $value) {
			$str .= "WHEN news_st = \"".$key."\" THEN \"".$value."\" ";
		}
		return $str;
	}

	private function caseDischSt() {
		$status = $this->status();
		$str = "";
		foreach ($status['disch_st'] as $key => $value) {
			$str .= "WHEN disch_st = \"".$key."\" THEN \"".$value."\" ";
		}
		return $str;
	}

	private function caseNation() {
		$query_globalcountry = GlobalCountry::all()->toArray();
		$str = "";
		foreach ($query_globalcountry as $key => $value) {
			$str .= "WHEN nation = \"".$value['country_id']."\" THEN \"".$value['country_name']."\" ";
		}
		return $str;
	}

	public function dataTable($query) {
		$pts = $this->casePtStatus();
		$ns = $this->caseNewsSt();
		$dcs = $this->caseDischSt();
		$nation = $this->caseNation();

		return datatables()
			->eloquent($query)
			->filterColumn('pt_status', function($query, $keyword) use ($pts) {
				$query->whereRaw('(CASE '.$pts.' ELSE "-" END) like ?', ["%{$keyword}%"]);
			})
			->filterColumn('news_st', function($query, $keyword) use ($ns) {
				$query->whereRaw('(CASE '.$ns.' ELSE "-" END) like ?', ["%{$keyword}%"]);
			})
			->filterColumn('disch_st', function($query, $keyword) use ($dcs) {
				$query->whereRaw('(CASE '.$dcs.' ELSE "-" END) like ?', ["%{$keyword}%"]);
			})
			->filterColumn('nation', function($query, $keyword) use ($nation) {
				$query->whereRaw('(CASE '.$nation.' ELSE "-" END) like ?', ["%{$keyword}%"]);
			})
			->editColumn('sat_id', function($sid) {
				if (!isset($sid->sat_id) || empty($sid->sat_id)) {
					$sid_rs = "<span class=\"badge badge-light font-0875\">-</span>";
				} else {
					$sid_rs = "<span class=\"badge badge-light font-1\">".$sid->sat_id."</span>";
				}
				return $sid_rs;
			})
			->editColumn('order_pt', function($sid) {
				if (!isset($oid->order_pt) || empty($oid->order_pt)) {
					$oid_rs = "<span class=\"font-1\">-</span>";
				} else {
					$oid_rs = "<span class=\"font-1\">".$oid->order_pt."</span>";
				}
				return $oid_rs;
			})
			->editColumn('pt_status', function($pts) {
				if (!isset($pts->pt_status) || empty($pts->pt_status)) {
					$pts_rs = "-";
				} else {
					switch (mb_strtolower($pts->pt_status)) {
						case "pui" :
							$pts_rs = "<span class=\"badge badge-light font-1\">".$pts->pt_status."</span>";
							break;
						case "confirmed" :
							$pts_rs = "<span class=\"badge badge-danger font-1\">".$pts->pt_status."</span>";
							break;
						case "probable" :
							$pts_rs = "<span class=\"badge badge-warning font-1\">".$pts->pt_status."</span>";
							break;
						case "suspected" :
							$pts_rs = "<span class=\"badge badge-custom-1 font-1\">".$pts->pt_status."</span>";
							break;
						case "excluded" :
							$pts_rs = "<span class=\"badge badge-success font-1\">".$pts->pt_status."</span>";
							break;
						default :
							$pts_rs = $pts->pt_status;
							break;
					}
				}
				return $pts_rs;
			})
			->editColumn('inv', function($iv) {
				if (!isset($iv->inv) || empty($iv->inv)) {
					$inv_rs = "<span class=\"badge badge-light\">-</span>";
				} elseif ($iv->inv == 'y') {
					$inv_rs = "<span class=\"badge badge-custom-3\"><i class=\"fa fa-check-circle\"></i> Investigated</span>";
				} else {
					$inv_rs = "-";
				}
				return $inv_rs;
			})
			->addColumn('action',
				'<a href="http://viral.ddc.moph.go.th/viral/lab/genlab.php?idx={{ $sat_id }}" target="_blank" title="GenLAB" class="btn btn-cyan btn-sm">GenLAB</a>
				<a href="http://viral.ddc.moph.go.th/viral/lab/labfollow.php?idx={{ $sat_id }}" target="_blank" title="LabResult" class="btn btn-primary btn-sm">LabResult</a>
				<button class="btn btn-custom-6 btn-sm chstatus" value="{{ $id }}" id="invest_idx{{ $id }}" title="{{ $id }}">Status</button>
				 <a href="{{ route("screenpui.edit", $id) }}" title="Invest form" class="btn btn-warning btn-sm">Edit</a>
				 ')
			->rawColumns(['order_pt', 'sat_id', 'pt_status', 'inv', 'action']);
	}

	public function query(InvestList $model) {
		$pts = $this->casePtStatus();
		$ns = $this->caseNewsSt();
		$dcs = $this->caseDischSt();
		$nation = $this->caseNation();

		$invest = InvestList::select(
			'id',
			'sat_id',
			'order_pt',
			\DB::raw('(CASE '.$pts.' ELSE "-" END) AS pt_status'),
			\DB::raw('(CASE '.$ns.' ELSE "-" END) AS news_st'),
			\DB::raw('(CASE '.$dcs.' ELSE "-" END) AS disch_st'),
			'sex',
			\DB::raw('(CASE '.$nation.' ELSE "-" END) AS nation'),
			'inv')->whereNull('deleted_at')->orderBy('id');

		return $invest;
	}

	public function html() {
		return $this->builder()
			->setTableId('list-data-table')
			->columns($this->getColumns())
			->minifiedAjax()
			->dom('Bfrtip')
			->orderBy(0)
			->responsive(true)
			->parameters(
				[ "language"=>[
						"url" => "/assets/libs/datatables-1.10.20/i18n/thai.json"
					]
				]
			)
			->lengthMenu([20]);
			/*
			->buttons(
				Button::make('create'),
				Button::make('export'),
				Button::make('print'),
				Button::make('reset'),
				Button::make('reload')

			); */
	}

	protected function getColumns() {
		return [
			Column::make('sat_id')->title('SatID'),
			Column::make('order_pt')->title('OrderID'),
			Column::make('pt_status')->title('Status'),
			Column::make('news_st')->title('News'),
			Column::make('disch_st')->title('Discharge'),
			Column::make('sex')->title('Sex'),
			Column::make('nation')->title('Nations'),
			Column::make('inv')->title('Invest'),
			Column::computed('action')
				->exportable(false)
				->printable(false)
				->addClass('text-right')
				->title('#'),
			];
	}

	protected function filename() {
		return 'DataList_' . date('YmdHis');
	}
}

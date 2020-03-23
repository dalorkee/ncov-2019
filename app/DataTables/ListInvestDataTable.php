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
use Barryvdh\DomPDF\PDF;

class ListInvestDataTable extends DataTable
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

	/**
	* Build DataTable class.
	*
	* @param mixed $query Results from query() method.
	* @return \Yajra\DataTables\DataTableAbstract
	*/

	public function dataTable($query) {
		$pts = $this->casePtStatus();
		$ns = $this->caseNewsSt();
		$dcs = $this->caseDischSt();
		$nation = $this->caseNation();

		return datatables()
			->eloquent($query)
			->orderColumn('order_pt', '-order_pt $1')
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
			/*
			->editColumn('news_st', function($ns) {
				if (!isset($ns->news_st) || empty($ns->news_st)) {
					$ns_rs = "-";
				} else {
					switch (mb_strtolower($ns->news_st)) {
						case "confirmed publish" :
							$ns_rs = "<span class=\"text-success\">".$ns->news_st."</span>";
							break;
						default :
							$ns_rs = "<span class=\"text-color-custom-6\">".$ns->news_st."</span>";
							break;
					}
				}
				return $ns_rs;
			})
			->editColumn('disch_st', function($dcs) use ($master_status) {
				if (!isset($dcs->disch_st) || empty($dcs->disch_st)) {
					$dcs_rs = "-";
				} else {
					$dcs_rs = $master_status['disch_st'][$dcs->disch_st];
				}
				return $dcs_rs;
			})
			->editColumn('nation', function($nt) use ($globalcountry) {
				if (!isset($nt->nation) || empty($nt->nation)) {
					$nt_rs = "-";
				} else {
					$nt_rs = $globalcountry[$nt->nation];
				}
				return $nt_rs;
			}) */

			->addColumn('action',
				/*'<a href="http://viral.ddc.moph.go.th/viral/lab/genlab.php?idx={{ $sat_id }}" target="_blank" title="GenLAB" class="btn btn-cyan btn-sm">GenLAB</a>
				<a href="http://viral.ddc.moph.go.th/viral/lab/labfollow.php?idx={{ $sat_id }}" target="_blank" title="LabResult" class="btn btn-primary btn-sm">LabResult</a>
				<button class="btn btn-custom-6 btn-sm chstatus" value="{{ $id }}" id="invest_idx{{ $id }}" title="{{ $id }}">Status</button>
				 <a href="{{ route("contacttable", $id) }}" title="Contact form" class="btn btn-info btn-sm">Contact</a>
				 <a href="{{ route("confirmForm", $id) }}" title="Invest form" class="btn btn-warning btn-sm">Edit</a> */
				 '<button class="context-nav btn btn-custom-1 btn-sm" data-satid="{{ $sat_id }}" data-id="{{ $id }}">Manage <i class="fas fa-angle-down"></i></button>')
			->rawColumns(['pt_status', 'inv', 'action']);
	}

	/**
	* Get query source of dataTable.
	*
	* @param \App\InvestList $model
	* @return \Illuminate\Database\Eloquent\Builder
	*/
	public function query(InvestList $model) {
		$pts = $this->casePtStatus();
		$ns = $this->caseNewsSt();
		$dcs = $this->caseDischSt();
		$nation = $this->caseNation();

		$invest = InvestList::select(
			'id',
			'order_pt',
			'sat_id',
			\DB::raw('(CASE '.$pts.' ELSE "-" END) AS pt_status'),
			\DB::raw('(CASE '.$ns.' ELSE "-" END) AS news_st'),
			\DB::raw('(CASE '.$dcs.' ELSE "-" END) AS disch_st'),
			'sex',
			\DB::raw('(CASE '.$nation.' ELSE "-" END) AS nation'),
			'inv')->whereNull('deleted_at');

		return $invest;

		/*
		return $model->newQuery('id', 'sat_id', 'pt_status', 'news_st', 'disch_st', 'sex', 'nation')
			->whereNull('deleted_at')->orderBy('id');
		*/

		/*
		$invest = InvestList::select('id', 'sat_id', 'pt_status', 'news_st', 'disch_st', 'sex', 'nation',
			\DB::raw('(CASE
				WHEN pt_status = "1" THEN "ok"
				ELSE "nok"
				END) AS xst'))->whereNull('deleted_at')->orderBy('id');
		return $invest;
		*/
		/*
		return $model->newQuery()
			->leftJoin('ref_pt_status', 'ref_pt_status.pts_id', '=', 'invest_pt.pt_status')
			->leftJoin('ref_disch_status', 'ref_disch_status.dcs_id', '=', 'invest_pt.disch_st')
			->whereNull('deleted_at')
			->orderBy('invest_pt.id');
		*/
	}

	/**
	* Optional method if you want to use html builder.
	*
	* @return \Yajra\DataTables\Html\Builder
	*/
	public function html() {
		return $this->builder()
			->setTableId('list-data-table')
			->columns($this->getColumns())
			->minifiedAjax()
			->dom('frtip')
			->orderBy(0)
			->responsive(true)
			->parameters(
				[ "language"=>[
						"url" => "/assets/libs/datatables-1.10.20/i18n/thai.json"
					]
				]
			)
			->lengthMenu([20])
			->buttons(
				Button::make('create'),
				Button::make('export'),
				Button::make('print'),
				Button::make('reset'),
				Button::make('reload')
			);
	}

	/**
	* Get columns.
	*
	* @return array
	*/
	protected function getColumns() {
		return [
			Column::make('order_pt')->title('OrderID'),
			Column::make('sat_id')->title('SatID'),
			Column::make('pt_status')->title('Status'),
			Column::make('news_st')->title('News'),
			Column::make('disch_st')->title('Discharge'),
			Column::make('sex')->title('Sex'),
			Column::make('nation')->title('Nations'),
			Column::make('inv')->title('Invest'),
			Column::computed('action')
				->exportable(true)
				->printable(false)
				->addClass('text-left')
				->title('#'),
			];
	}

	/**
	* Get filename for export.
	*
	* @return string
	*/
	protected function filename() {
		return 'DataList_' . date('YmdHis');
	}
}

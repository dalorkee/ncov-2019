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

class ListInvestDataTable extends DataTable
{

	public function status() {
		$master = new MasterController;
		$status = $master->getStatus();
		return $status;
	}
	/**
	* Build DataTable class.
	*
	* @param mixed $query Results from query() method.
	* @return \Yajra\DataTables\DataTableAbstract
	*/

	public function dataTable($query) {
		$master_status = $this->status();
		$query_globalcountry = GlobalCountry::all();
		foreach ($query_globalcountry as $value) {
			$globalcountry[$value->country_id] = $value->country_name;
		}
		return datatables()
			->eloquent($query)
			->editColumn('pt_status', function($pts) use ($master_status) {
				if (!isset($pts->pt_status) || empty($pts->pt_status)) {
					$pts_rs = "-";
				} else {
					$pts_rs = $master_status['pt_status'][$pts->pt_status];
				}
				return $pts_rs;
			})
			->editColumn('disch_st', function($dcs) use ($master_status) {
				if (!isset($dcs->disch_st) || empty($dcs->disch_st)) {
					$dcs_rs = "-";
				} else {
					$dcs_rs = $master_status['disch_st'][$dcs->disch_st];
				}
				return $dcs_rs;
				//return '<span class="text-danger">'.$dcs->dcs_name_en.'</span>';
			})
			->editColumn('news_st', function($ns) use ($master_status) {
				if (!isset($ns->news_st) || empty($ns->news_st)) {
					$ns_rs = "-";
				} else {
					$ns_rs = $master_status['news_st'][$ns->news_st];
				}
				return $ns_rs;
			})
			->editColumn('nation', function($nt) use ($globalcountry) {
				if (!isset($nt->nation) || empty($nt->nation)) {
					$nt_rs = "-";
				} else {
					$nt_rs = $globalcountry[$nt->nation];
				}
				return $nt_rs;
			})
			->addColumn('action',
				'<button class="btn btn-success btn-sm margin-5 text-white" data-toggle="modal" title="Change status" data-target="#chstatus">ST</button>
				 <button class="btn btn-warning btn-sm testja" value="{{ $id }}" id="invest_idx{{ $id }}">Edit</button>')
			->rawColumns(['pt_status', 'disch_st', 'action', 'action1']);
	}

	/**
	* Get query source of dataTable.
	*
	* @param \App\InvestList $model
	* @return \Illuminate\Database\Eloquent\Builder
	*/
	public function query(InvestList $model) {
		return $model->newQuery()->whereNull('deleted_at')->orderBy('id');
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
			->dom('Bfrtip')
			->orderBy(1)
			->responsive(true)
			->buttons(
				/* Button::make('create'), */
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
			Column::make('id'),
			Column::make('sat_id')->title('SatID'),
			Column::make('pt_status')->title('Status'),
			Column::make('news_st')->title('News'),
			Column::make('disch_st')->title('Discharge'),
			Column::make('sex'),
			Column::make('nation'),
			Column::computed('action')
				->exportable(false)
				->printable(false)
				->addClass('text-left'),
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

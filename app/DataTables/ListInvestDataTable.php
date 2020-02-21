<?php

namespace App\DataTables;

use App\InvestList;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;
use App\Http\Controllers\MasterController;

class ListInvestDataTable extends DataTable
{

	public function masterData() {
		$data = new MasterController;
		$status = $data->getStatus();
		return $status;
	}
	/**
	* Build DataTable class.
	*
	* @param mixed $query Results from query() method.
	* @return \Yajra\DataTables\DataTableAbstract
	*/
	public function dataTable($query) {
		$status = collect([
					'pt_status' => [
						'1' => 'PUI',
						'2' => 'Confirmed',
						'3' => 'Probable',
						'4' => 'Suspected',
						'5' => 'Excluded'
					]
				]);
		return datatables()
			->eloquent($query, $status)
			->editColumn('pt_status', $status["pt_status"][1].'{{ $pt_status }}')
			->addColumn('action', '<a href="#" class="btn btn-danger btn-sm">'.$status['pt_status'][1].'</a>')
			->rawColumns(['link', 'action']);
	}

	/**
	* Get query source of dataTable.
	*
	* @param \App\InvestList $model
	* @return \Illuminate\Database\Eloquent\Builder
	*/
	public function query(InvestList $model) {
		return $model->newQuery()->whereNull('deleted_at');
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
			->buttons(
				/*Button::make('create'),
				Button::make('export'),
				Button::make('print'), */
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
			Column::make('sat_id'),
			Column::make('pt_status'),
			Column::make('news_st'),
			Column::make('disch_st'),
			Column::computed('action')
				->exportable(false)
				->printable(false)
				->width(60)
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

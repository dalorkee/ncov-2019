<?php

namespace App\DataTables;

use App\DataList;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;

class DataListDataTable extends DataTable
{
	/**
	* Build DataTable class.
	*
	* @param mixed $query Results from query() method.
	* @return \Yajra\DataTables\DataTableAbstract
	*/
	public function dataTable($query) {
		return datatables()
			->eloquent($query)
			->addColumn('action', '<a href="#" class="btn btn-danger btn-sm">isad</a>');
		}

	/**
	* Get query source of dataTable.
	*
	* @param \App\DataList $model
	* @return \Illuminate\Database\Eloquent\Builder
	*/
	public function query(DataList $model) {
		return $model->newQuery();
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
			Column::computed('action')
				->exportable(false)
				->printable(false)
				->width(60)
				->addClass('text-center'),
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

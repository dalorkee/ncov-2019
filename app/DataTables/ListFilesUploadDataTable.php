<?php
namespace App\DataTables;

use App\FilesUpload;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Services\DataTable;
use App\Http\Controllers\MasterController;

class ListFilesUploadDataTable extends DataTable
{
	private function getFileType() {
		$master = new MasterController;
		$file_type = $master->setFileUploadType();
		return $file_type;
	}

	public function dataTable($query) {
		$file_type_arr = $this->getFileType();
		return datatables()
			->eloquent($query)
			->editColumn('file_upload_type', function($file_type) use ($file_type_arr) {
				switch ($file_type->file_upload_type) {
					case 'invest' :
						$file_type_rs = '<span class="badge badge-custom-2 font-1">'.$file_type_arr[$file_type->file_upload_type].'</span>';
						break;
					default :
						$file_type_rs = '-';
						break;
				}
				return $file_type_rs;
			})
			->addColumn('action', '<button class="context-nav btn btn-custom-1 btn-sm" data-satid="x" data-id="y">Manage <i class="fas fa-angle-down"></i></button>')
			->rawColumns(['file_upload_type', 'action']);
	}

	public function query(FilesUpload $model) {
		return $model->newQuery()->orderBy('id', 'ASC');
	}

	public function html() {
		return $this->builder()
			->setTableId('files-table')
			->columns($this->getColumns())
			->minifiedAjax()
			->dom('frtip')
			->orderBy(0)
			->responsive(true)
			->parameters(
				[ 'language'=>[
						'url' => url('/assets/libs/datatables-1.10.20/i18n/thai.json')
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

	protected function getColumns() {
		return [
			Column::make('id')->title('รหัส'),
			Column::make('file_name')->title('ชื่อไฟล์'),
			Column::make('file_upload_type')->title('ประเภท'),
			Column::make('file_detail')->title('รายละเอียด'),
			Column::computed('action')
				->exportable(false)
				->printable(false)
				->width(60)
				->addClass('text-left')
				->title('#')
		];
	}

	protected function filename() {
		return 'ListFilesUpload_' . date('YmdHis');
	}
}

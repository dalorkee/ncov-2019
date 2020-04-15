<?php

namespace App\Exports;

use Illuminate\Database\Eloquent\Model;

class LogExport extends Model
{
	protected $table = 'log_export';
	protected $primaryKey = 'id';

	protected $fillable = [
		'ref_user_id',
		'file_name',
		'file_imme_type',
		'file_size',
		'export_amoung',
		'expire_date',
		'last_export_date'
	];

}

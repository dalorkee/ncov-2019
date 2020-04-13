<?php

namespace App\Exports;

use Illuminate\Database\Eloquent\Model;

class LogExport extends Model
{
	protected $table = 'log_export';
	protected $primaryKey = 'id';
	public $timestamps = true;

}

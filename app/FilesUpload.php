<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FilesUpload extends Model
{
	use SoftDeletes;

	protected $table = 'files_upload';
	protected $primaryKey = 'id';
	public $fillable = ['id','file_name'];
	protected $dates = ['deleted_at'];
}

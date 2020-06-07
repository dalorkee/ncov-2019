<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FilesUpload extends Model
{
	use SoftDeletes;

	protected $table = 'files_upload';
	protected $primaryKey = 'id';
	protected $fillable = ['id','file_name'];
}

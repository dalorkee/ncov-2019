<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ListData extends Model
{
	use SoftDeletes;

	protected $table = 'invest_pt';
	protected $primaryKey = 'id';
	public $timestamps = true;

	protected $fillable = [
		'id', 'sat_id',
	];
}

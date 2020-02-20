<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataList extends Model
{
	protected $table = 'invest_pt';
	protected $primaryKey = 'id';
	public $timestamps = true;

	protected $fillable = [
		'id', 'sat_id',
	];
}

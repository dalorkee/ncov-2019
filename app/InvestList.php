<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvestList extends Model
{
	use SoftDeletes;

	protected $table = 'invest_pt';
	protected $primaryKey = 'id';
	public $timestamps = true;

	protected $fillable = [
		'sat_id',
		'created_at',
		'updated_at',
		'deleted_at'
	];

	protected $dates = ['deleted_at'];

}

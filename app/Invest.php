<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invest extends Model
{
	use SoftDeletes;

	protected $table = 'invest_pt';
	protected $primaryKey = 'id';
	public $timestamps = true;

	protected $fillable = [
		'card_id',
		'passport',
		'pt_status',
		'created_at'
	];
}

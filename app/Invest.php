<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invest extends Model
{
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

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invest extends Model
{
	protected $table = 'invest_pt';
	protected $primaryKey = 'id';
	public $timestamps = true;

	protected $fillable = [
		'created_at'
	];
}

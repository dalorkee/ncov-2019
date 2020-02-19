<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListData extends Model
{
	protected $table = 'invest_pt';
	protected $primaryKey = 'id';
	public $timestamps = true;
}

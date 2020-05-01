<?php

namespace App\Db2;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invest2 extends Model
{
	use SoftDeletes;

	protected $connection = 'mysql2';
	protected $table = 'invest_pt';
	protected $primaryKey = 'id';
	public $timestamps = true;
}

<?php

namespace App\Db2;

use Illuminate\Database\Eloquent\Model;

class RiskType2 extends Model
{
	protected $connection = 'mysql2';
	protected $table = 'ref_risk';
	protected $primaryKey = 'id';
}

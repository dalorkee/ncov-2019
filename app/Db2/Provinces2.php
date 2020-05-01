<?php

namespace App\Db2;

use Illuminate\Database\Eloquent\Model;

class Provinces2 extends Model
{
	protected $connection = 'mysql2';
	protected $table = 'ref_province';
	protected $primaryKey = 'province_id';
}

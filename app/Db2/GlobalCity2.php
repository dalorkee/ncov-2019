<?php

namespace App\Db2;

use Illuminate\Database\Eloquent\Model;

class GlobalCity2 extends Model
{
	protected $connection = 'mysql2';
	protected $table = 'ref_global_city';
	protected $primaryKey = 'city_id';
}

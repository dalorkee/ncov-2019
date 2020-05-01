<?php

namespace App\Db2;

use Illuminate\Database\Eloquent\Model;

class GlobalCountry2 extends Model
{
	protected $connection = 'mysql2';
	protected $table = 'ref_global_country';
	protected $primaryKey = 'country_id';
}

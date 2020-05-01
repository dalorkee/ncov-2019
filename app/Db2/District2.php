<?php

namespace App\Db2;

use Illuminate\Database\Eloquent\Model;

class District2 extends Model
{
	protected $connection = 'mysql2';
	protected $table = 'ref_district';
	protected $primaryKey = 'district_id';
}

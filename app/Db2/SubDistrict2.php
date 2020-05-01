<?php

namespace App\Db2;

use Illuminate\Database\Eloquent\Model;

class SubDistrict2 extends Model
{
	protected $connection = 'mysql2';
	protected $table = 'ref_sub_district';
	protected $primaryKey = 'sub_district_id';
}

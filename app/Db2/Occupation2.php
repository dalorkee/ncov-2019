<?php

namespace App\Db2;

use Illuminate\Database\Eloquent\Model;

class Occupation2 extends Model
{
	protected $connection = 'mysql2';
	protected $table = 'ref_occupation';
	protected $primaryKey = 'id';
}

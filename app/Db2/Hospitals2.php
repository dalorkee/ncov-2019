<?php

namespace App\Db2;

use Illuminate\Database\Eloquent\Model;

class Hospitals2 extends Model
{
	protected $connection = 'mysql2';
	protected $table = 'chospital_new';
	protected $primaryKey = 'hospcode';
}

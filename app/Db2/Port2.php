<?php

namespace App\Db2;

use Illuminate\Database\Eloquent\Model;

class Port2 extends Model
{
	protected $connection = 'mysql2';
	protected $table = 'ref_port';
	protected $primaryKey = 'port_id';
}

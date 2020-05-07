<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SessionToken extends Model
{
	protected $table = 'session_tokens';
	protected $primaryKey = 'id';
}

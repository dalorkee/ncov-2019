<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
	use Notifiable, HasRoles;

	public $timestamps = true;

	//protected $connection = 'mysql';

	/**
	* The attributes that are mass assignable.
	*
	* @var array
	*/
	protected $fillable = [
		'id',
		'username',
		'password',
		'title_name',
		'name',
		'lname',
		'wposi',
		'email',
		'tel',
		'usergroup',
		'dtnow',
		'prefix_sat_id',
		'hospcode',
		'prov_code',
		'ampur_code',
		'tambol_code',
		'region',
		'position',
		'card_id',
		'hospname',
		'chk_regis',
		'create_user_permission'
	];

	/**
	* The attributes that should be hidden for arrays.
	*
	* @var array
	*/
	protected $hidden = [
		'password', 'remember_token',
	];

	/**
	* The attributes that should be cast to native types.
	*
	* @var array
	*/

	protected $casts = [
		'email_verified_at' => 'datetime',
	];


}

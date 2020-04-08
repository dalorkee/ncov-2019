<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatientActivity extends Model
{
	protected $table = 'pt_activity';
	protected $primaryKey = 'id';
	protected $fillable = [
		'id',
		'ref_patient_id',
		'day',
		'date_activity',
		'activity',
		'place',
		'personal_amount',
		'personal_name'
	];
}

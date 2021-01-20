<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactList extends Model
{
	use SoftDeletes;

  protected $table = 'tbl_contact';
  protected $primaryKey = 'id';
  public $timestamps = true;
  
  protected $fillable = [
    'id',
    'colab_send'
	];
}

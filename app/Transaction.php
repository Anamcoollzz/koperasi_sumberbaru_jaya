<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{

	public $timestamps = false;
	protected $fillable = ['nota', 'created_at', 'payin', 'cashier'];
}

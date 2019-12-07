<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetailTransaction extends Model
{

	public $timestamps = false;
	protected $fillable = ['product', 'price', 'quantity', 'transaction', 'sell_price'];
}

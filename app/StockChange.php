<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockChange extends Model
{
    public $timestamps = false;
    protected $fillable = ['product', 'change', 'created_at'];

}

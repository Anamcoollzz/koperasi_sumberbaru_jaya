<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cashier extends Model
{
    public $timestamps = false;
    protected $fillable = ['name', 'gender', 'city', 'birthdate', 'address', 'login'];
}

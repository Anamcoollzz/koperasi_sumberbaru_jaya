<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    public $timestamps = false;
    protected $fillable = ['name', 'gender', 'city', 'birthdate', 'address', 'login'];
}

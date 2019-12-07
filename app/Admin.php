<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    public $timestamps = false;
    protected $fillable = ['name', 'gender', 'city', 'birthdate', 'address', 'login'];
}

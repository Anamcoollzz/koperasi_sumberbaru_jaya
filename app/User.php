<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    public $table = 'logins';
    protected $fillable = ['username', 'password', 'remember_token', 'level'];
    protected $hidden = ['avatar'];
    public $timestamps = false;
}

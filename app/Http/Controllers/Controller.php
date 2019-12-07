<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Admin as A;
use App\Cashier as Cs;
use App\Manager as M;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // protected function profile()
    // {
    //     $avatar=asset('images/avatars/default.png');
    //     if(Auth::user()->avatar!=null)
    //         $avatar = asset('storage/'.Auth::user()->avatar);
    //     $level = Auth::user()->level;
    //     $admin = $level==1;
    //     $manager = $level==2;
    //     $cashier = $level==3;
    //     if($admin){
    //         $tbl = A::where('login', '=', Auth::user()->id)->first();
    //         $level = 'Administrator';
    //     }
    //     else if($cashier){
    //         $tbl = Cs::where('login', '=', Auth::user()->id)->first();
    //         $level = 'Kasir';
    //     }
    //     else if($manager){
    //         $tbl = M::where('login', '=', Auth::user()->id)->first();
    //         $level = 'Manajer';
    //     }
    //     $name = $tbl->name;
    //     $gender = $tbl->gender;
    //     $city = $tbl->city;
    //     $birthdate = $tbl->birthdate;
    //     $address = $tbl->address;
    //     // dd($avatar);
    //     $profile = [
    //         'avatar'        => $avatar,
    //         'name'          => $name,
    //         'level'         => $level,
    //         'gender'        => $gender,
    //         'city'          => $city,
    //         'birthdate'     => indo_date($birthdate),
    //         'address'       => $address,
    //     ];
    //     return (object) $profile;
    // }
}

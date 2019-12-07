<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Backup as B;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BackupController extends Controller
{
    public function index()
    {
    	$oper = array(
            'title'   => 'Data Backup'.title(),
            'modul'   => 'backup',
            'data'    => B::latest()->get(),
            'profile' => $this->profile()
            );
    	return view('categories.index', $oper);
    }
}

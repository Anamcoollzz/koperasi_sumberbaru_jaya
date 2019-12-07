<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
 
    public function index()
    {
        $data = DB::table('detail_transactions')
            ->join('transactions', 'transactions.id', '=', 'detail_transactions.transaction')
            ->select(DB::raw('date(created_at) as day, SUM(quantity) as quantity, SUM(price) as modal, SUM(sell_price) as omset, SUM(sell_price-price) as income'))
            ->groupBy('day')
            // ->havingRaw('day BETWEEN \''.date('Y-m').'-01\' and \''.date('Y-m-d').'\'')
            ->get();
        $data2 = DB::table('detail_transactions')
            ->join('transactions', 'transactions.id', '=', 'detail_transactions.transaction')
            ->select(DB::raw('month(created_at) as month, SUM(quantity) as quantity, SUM(price) as modal, SUM(sell_price) as omset, SUM(sell_price-price) as income'))
            ->groupBy('month')
            // ->havingRaw('day BETWEEN \''.date('Y-m').'-01\' and \''.date('Y-m-d').'\'')
            ->get();
        $oper = [
            'title'     => 'Beranda'.title(),
            'profile'   => $this->profile(),
            'modul'     => 'home',
            'data'      => $data,
            'data2'      => $data2
        ];
        return view('home.home', $oper);
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\DetailTransaction as DT;

class ReportController extends Controller
{
    private $waktu;
    private function productsQuery($time=null)
    {
        $this->waktu = 'Semua';
        $DT = DB::table('detail_transactions')
            ->join('products', 'products.id', '=', 'detail_transactions.product')
            ->join('transactions', 'transactions.id', '=', 'detail_transactions.transaction');
        if(is_array($time)){
            $month = $time['month'];
            if($month<10)
                $month = '0'.$month;
            $DT = $DT->whereRaw('date(transactions.created_at) LIKE \''.$time['year'].'-'.$month.'%\'');
            $this->waktu = month_name($time['month']).' '.$time['year'];
        }else{
            if($time=='today'){
                $DT = $DT->whereRaw('date(transactions.created_at) =\''. date('Y/m/d').'\'');
                $this->waktu = indo_date(date('Y-m-d'));
            }
            else if($time=='yesterday'){
                $DT = $DT->whereRaw('date(transactions.created_at) =\''. date('Y/m/d', strtotime('-1 days')).'\'');
                $this->waktu = indo_date(date('Y/m/d', strtotime('-1 days')));
            }
            else if($time=='thisweek'){
                $DT = $DT->whereRaw('date(transactions.created_at) between \''. date('Y/m/d', strtotime('last sunday')).'\' and \''.date('Y/m/d').'\'');
                $this->waktu = indo_date(date('Y/m/d', strtotime('last sunday'))).' - '.indo_date(date('Y/m/d'));
            }
            else if($time=='thismonth'){
                $DT = $DT->whereRaw('date(transactions.created_at) between \''. date('Y/m/01').'\' and \''.date('Y/m/d').'\'');
                $this->waktu = month_name(date('m')).' '.date('Y');
            }
            else if(strpos($time, '-') !==false){
                $DT = $DT->whereRaw('date(transactions.created_at)=\''.eng_date($time).'\'');
                $this->waktu = indo_date(date('Y-m-d', strtotime(eng_date($time))));
            }
        }
        $DT = $DT->select(DB::raw('products.name, detail_transactions.*, SUM(quantity) as quantity'))
            ->groupBy('name', 'detail_transactions.price')
            ->get();
        return $DT;
    }

    private function pro($time=null)
    {
        $oper = [
            'title'     => 'Laporan Penjualan',
            'data'      => $this->productsQuery($time),
            'modul'     => 'products_report',
            'time'      => $time,
            'month'     => null,
            'year'      => null,
            'waktu'     => $this->waktu,
            'profile'   => $this->profile()
        ];
        if(is_array($time)){
            $oper['month'] = $time['month'];
            $oper['year'] = $time['year'];
            $oper['time']   = 'bebas';
        }
        return $oper;
    }

    function product()
    {
        $oper = $this->pro();
        return view('report.detail_transaction', $oper);
    }

    public function products($time)
    {
        $oper = $this->pro($time);
        return view('report.detail_transaction', $oper);
    }

    function productsDetail($month, $year)
    {
        $time = ['month'=>$month,'year'=>$year];
        $oper = $this->pro($time);
        return view('report.detail_transaction', $oper);
    }

    function printproducts($time)
    {
        $oper = $this->pro($time);
        return view('report.printproducts', $oper);
    }

    function printproductsDetail($month, $year)
    {
        $time = ['month'=>$month,'year'=>$year];
        $oper = $this->pro($time);
        return view('report.printproducts', $oper);
    }
}

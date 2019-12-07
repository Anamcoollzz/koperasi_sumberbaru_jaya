<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Product as P;
use App\Cashier as Cs;
use App\Transaction as T;
use App\DetailTransaction as DT;

class TransactionController extends Controller
{
    public function index()
    {
        $data = DB::table('transactions')
                ->join('cashiers', 'cashiers.id', '=', 'transactions.cashier')
                ->select('cashiers.name', 'transactions.*')
                ->orderBy('created_at', 'desc')
                ->get();
        $oper = array(
            'title'         => 'Penjualan'.title(),
            'modul'         => 'transaction',
            'data'          => $data,
            'add'           => route('transaction.add'),
            'profile'       => $this->profile()
        );
        return view('transactions.index', $oper);
    }

    public function add()
    {
        $oper = array(
            'title'         => 'Tambah Penjualan'.title(),
            'modul'         => 'transaction',
            'action'        => route('transaction.create'),
            'back'          => route('transactions'),
            'profile'       => $this->profile()
        );
        return view('transactions.add', $oper);
    }

    public function checkprice(Request $request)
    {
        $data = array();
        $i = 0;
        // dd($request->quantity);
        foreach ($request->barcode as $b) {
            $P = P::where(['barcode' => $b])->first();
            $data[] = [
                'name'          => $P->name,
                'price'         => $P->sell_price,
                'stock'         => $P->stock,
                'quantity'      => $request->quantity[$i],
                'payin'         => ($request->payin==null)?0:$request->payin
            ];
            $i++;
        }

        return $data;
    }

    public function create(Request $request)
    {
        for($i=0; $i<count($request->barcode); $i++){
            $P = P::where('barcode', $request->barcode[$i])->first();
            if($P->stock<$request->quantity[$i]){
                $status = 'failed';
                $msg = 'Ada stok yang tidak mencukupi!!!';
                return redirect()->back()->with($status, $msg);
            }
        }

        $nota = date('YmdHis');
        T::create([
            'cashier'       => Cs::where('login', '=', Auth::user()->id)->first()->id,
            'payin'         => $request->payin,
            'nota'          => $nota
        ]);

        $id = T::where('nota', '=', $nota)->first()->id;

        for($i=0; $i<count($request->barcode); $i++){
            $P = P::where('barcode', '=', $request->barcode[$i])->first();
            DT::create([
                'product'       => $P->id,
                'quantity'      => $request->quantity[$i],
                'price'         => $P->price,
                'sell_price'    => $P->sell_price,
                'transaction'   => $id
            ]);
            P::where('barcode', $request->barcode[$i])
            ->update([
                'stock'     => $P->stock-=$request->quantity[$i]
            ]);
        }

        return redirect()->route('transactions')->with('success', 'Penjualan berhasil. Silakan cetak struk');
    }

    public function printstruct($id)
    {
        $DT = DB::table('detail_transactions')
            ->join('transactions', 'detail_transactions.transaction', '=', 'transactions.id')
            ->join('products', 'products.id', '=', 'detail_transactions.product')
            ->where('transaction', '=', $id)
            ->select('detail_transactions.*', 'products.name', 'transactions.payin')
            ->get();
        // dd($DT);
        $oper = [
            'data'      => $DT,
            'nota'      => T::find($id)->nota
        ];
        return view('transactions.struct', $oper);
    }

    public function detail($id)
    {
        $DT = DB::table('detail_transactions')
            ->join('transactions', 'detail_transactions.transaction', '=', 'transactions.id')
            ->join('products', 'products.id', '=', 'detail_transactions.product')
            ->where('transaction', '=', $id)
            ->select('detail_transactions.*', 'products.name', 'transactions.payin')
            ->get();
        return $DT;
    }

}


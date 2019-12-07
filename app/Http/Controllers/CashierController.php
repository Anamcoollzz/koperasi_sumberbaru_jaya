<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCashier;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Cashier as Cs;
use App\Admin as A;
use App\User as U;

class CashierController extends Controller
{
    
    public function index()
    {
        $data = DB::table('cashiers')
                ->join('logins', 'logins.id', '=', 'cashiers.login')
                ->select('cashiers.*', 'logins.username')
                ->orderBy('name', 'asc')
                ->get();
        $oper = array(
            'title'         => 'Data Kasir'.title(),
            'modul'         => 'cashier',
            'data'          => $data,
            'add'           => route('cashier.add'),
            'delete'        => route('cashier.delete'),
            'reset'         => route('cashier.reset'),
            'profile'       => $this->profile()
        );
        return view('cashiers.index', $oper);
    }

    public function add()
    {
        $oper = array(
            'title'         => 'Tambah Data Kasir'.title(),
            'modul'         => 'cashier',
            'action'        => route('cashier.create'),
            'back'          => route('cashiers'),
            'profile'       => $this->profile()
        );
        return view('cashiers.add', $oper);
    }

    public function create(CreateCashier $request)
    {
        U::create([
            'username'      => $request->username,
            'password'      => bcrypt($request->username),
            'level'         => 3
        ]);

        $login = U::where(['username'=>$request->username])->first()->id;

        Cs::create([
            'name'              => ucwords($request->name),
            'gender'            => $request->gender,
            'city'              => upper($request->city),
            'birthdate'         => eng_date($request->birthdate),
            'address'           => $request->address,
            'login'             => $login
        ]);

        return redirect()->route('cashiers')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data = Cs::find($id);
        $login = $data->login;
        $username = U::find($login)->username;
        $oper = array(
            'title'     => 'Ubah Data Kasir'.title(),
            'modul'     => 'cashier',
            'data'      => $data,
            'username'  => $username,
            'action'    => route('cashier.update', $id),
            'back'      => route('cashiers'),
            'profile'       => $this->profile()
        );
        return view('cashiers.edit', $oper);
    }

    public function update($id, Request $request)
    {
        $rules = [
            'name'          => 'required',
            'username'      => 'required|min:6'
        ];

        $nameIsChange = $request->username!=$request->old_username;

        if($nameIsChange)
            $rules['username']='required|min:6|unique:logins';

        $messages = [
            'username.unique'       => 'Username sudah digunakan',
            'username.min'          => 'Username minimal 6 huruf'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();

        if($nameIsChange)
            U::where(['username'=>$request->old_username])
                ->update([
                    'username'  => $request->username
            ]);

        Cs::where(['id'=>$id])->update([
            'name'              => $request->name,
            'gender'            => $request->gender,
            'city'              => upper($request->city),
            'birthdate'         => eng_date($request->birthdate),
            'address'           => $request->address
        ]);

        return redirect()->route('cashiers')->with('success', 'Data berhasil diubah');
    }

    public function delete(Request $request)
    {
        $login = Cs::find($request->id)->login;

        Cs::destroy($request->id);

        U::destroy($login);

        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }

    public function reset(Request $request)
    {
        $U = U::find($request->id);
        U::find($request->id)->update(['password'=>bcrypt($U->username)]);
        return redirect()->back()->with('success', 'Password berhasil direset');
    }
}

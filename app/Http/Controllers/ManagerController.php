<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCashier;
use App\Manager as M;
use App\User as U;

class ManagerController extends Controller
{
    public function index()
    {
        $data = DB::table('managers')
                ->join('logins', 'logins.id', '=', 'managers.login')
                ->select('managers.*', 'logins.username')
                ->orderBy('name', 'asc')
                ->get();
        $oper = array(
            'title'         => 'Data Manajer'.title(),
            'modul'         => 'manager',
            'data'          => $data,
            'add'           => route('manager.add'),
            'delete'        => route('manager.delete'),
            'reset'         => route('manager.reset'),
            'profile'       => $this->profile()
        );
        return view('managers.index', $oper);
    }

    public function add()
    {
        $oper = array(
            'title'         => 'Tambah Data Manajer'.title(),
            'modul'         => 'manager',
            'action'        => route('manager.create'),
            'back'          => route('managers'),
            'profile'       => $this->profile()
        );
        return view('managers.add', $oper);
    }

    public function create(CreateCashier $request)
    {
        U::create([
            'username'      => $request->username,
            'password'      => bcrypt($request->username),
            'level'         => 2
        ]);

        $login = U::where(['username'=>$request->username])->first()->id;

        M::create([
            'name'              => ucwords($request->name),
            'gender'            => $request->gender,
            'city'              => upper($request->city),
            'birthdate'         => eng_date($request->birthdate),
            'address'           => $request->address,
            'login'             => $login
        ]);

        return redirect()->route('managers')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data = M::find($id);
        $login = $data->login;
        $username = U::find($login)->username;
        $oper = array(
            'title'     => 'Ubah Data Manajer'.title(),
            'modul'     => 'manager',
            'data'      => $data,
            'username'  => $username,
            'action'    => route('manager.update', $id),
            'back'      => route('managers'),
            'profile'       => $this->profile()
        );
        return view('managers.edit', $oper);
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

        M::where(['id'=>$id])->update([
            'name'              => $request->name,
            'gender'            => $request->gender,
            'city'              => upper($request->city),
            'birthdate'         => eng_date($request->birthdate),
            'address'           => $request->address
        ]);

        return redirect()->route('managers')->with('success', 'Data berhasil diubah');
    }

    public function delete(Request $request)
    {
        $login = M::find($request->id)->login;

        M::destroy($request->id);

        U::destroy($login);

        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }

    public function reset(Request $request)
    {
        $U = U::find($request->id);
        U::where(['id'=>$request->id])->update(['password'=>bcrypt($U->username)]);
        return redirect()->back()->with('success', 'Password berhasil direset');
    }
}


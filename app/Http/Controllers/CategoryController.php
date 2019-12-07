<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category as C;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index()
    {
    	$oper = array(
            'title'     => 'Data Kategori'.title(),
            'modul'     => 'category',
    		'data'		=> C::orderBy('name', 'asc')->get(),
            'profile'       => $this->profile()
    	);
    	return view('categories.index', $oper);
    }

    public function add()
    {
        $oper = array(
            'title'     => 'Tambah Data Kategori'.title(),
            'modul'     => 'category',
            'data'      => C::orderBy('name', 'asc')->get(),
            'profile'       => $this->profile()
        );
    	return view('categories.add', $oper);
    }

    public function create(Request $request)
    {
    	$this->validate($request, [
    		'name'		=> 'unique:categories|required'
    		]
    	);

    	C::create([
    		'name'		=> $request->name
    	]);

    	return redirect()->route('categories')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
    	$oper = array(
            'title'     => 'Tambah Data Kategori'.title(),
            'modul'     => 'category',
    		'data'		=> C::find($id),
    		'id'		=> $id,
            'profile'       => $this->profile()
    	);
    	return view('categories.edit', $oper);
    }

    public function update($id, Request $request)
    {
    	$this->validate($request, [
    		'name'		=> 'unique:categories|required'
    		]
    	);

    	C::where(['id'=>$id])->update([
    		'name'		=> $request->name
    	]);

    	return redirect()->route('categories')->with('success', 'Data berhasil diubah');
    }

    public function delete(Request $request)
    {
    	C::destroy($request->id);

    	return redirect()->route('categories')->with('success', 'Data berhasil dihapus');
    }

    public function recycle()
    {
        // dd(Auth::user()->level);
        $oper = array(
            'title'     => 'Data Kategori Dihapus'.title(),
            'modul'     => 'categories_recycle',
            'data'      => DB::table('categories')->where('deleted_at','!=', 'null')->orderBy('name', 'asc')->get(),
            'profile'   => $this->profile()
        );
        return view('categories.recycle', $oper);
    }

    public function restore(Request $request)
    {
        C::where('id',$request->id)->restore();

        return redirect()->route('categories')->with('success', 'Data berhasil direstore');
    }
}

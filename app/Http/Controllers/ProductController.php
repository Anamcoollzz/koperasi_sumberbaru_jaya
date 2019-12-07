<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Product as P;
use App\Admin as A;
use App\Category as C;
use App\StockChange as S;

class ProductController extends Controller
{

    public function index($category)
    {
    	$data = DB::table('products')
    			->join('categories', 'categories.id', '=', 'products.category')
    			->select('products.*', 'categories.name as category_name')
    			->orderBy('name', 'asc');
    	if($category!='all') $data = $data->where(['category'=>$category]);
    	$data = $data->where('products.deleted_at', '=', null)
		    	->where('categories.deleted_at', '=', null)
    			->get();
    	$oper = array(
    		'title'			=> 'Produk'.title(),
    		'modul'			=> 'product',
    		'categories'	=> C::orderBy('name','asc')->get(),
    		'category'		=> $category,
    		'data'			=> $data,
    		'add'			=> route('product.add', $category),
    		'delete'		=> route('product.delete', $category),
            'profile'       => $this->profile()
    	);
        // dd($this->profile());
    	return view('products.index', $oper);
    }

    public function add($category)
    {
    	$oper = array(
    		'title'			=> 'Tambah Produk'.title(),
    		'modul'			=> 'product',
    		'categories'	=> C::orderBy('name', 'asc')->get(),
    		'action'		=> route('product.create', $category),
    		'back'			=> route('products', $category),
    		'category'		=> $category,
            'profile'       => $this->profile()
    	);
    	return view('products.add', $oper);
    }

    public function create($category, Request $request)
    {
    	$this->validate($request, [
    		'barcode'	=> 'unique:products|required',
    		'name'		=> 'unique:products|required'
    		]
    	);

    	P::create($request->all());

    	return redirect()->route('products', $request->category)->with('success', 'berhasil ditambahkan');
    }

    public function edit($category, $id)
    {
    	$oper = array(
            'title'     => 'Ubah Produk'.title(),
            'modul'     => 'product',
    		'data'		=> P::find($id),
    		'categories'	=> C::all(),
    		'category'		=> $category,
    		'action'		=> route('product.update', [$category, $id]),
    		'back'			=> route('products', $category),
            'profile'       => $this->profile()
    	);
    	return view('products.edit', $oper);
    }

    public function update($category, $id, Request $request)
    {
    	if($request->barcode!=$request->old_barcode){
    		$this->validate($request, [
    		'barcode'	=> 'unique:products|required'
    		]);
    	}

    	if($request->name!=$request->old_name){
    		$this->validate($request, [
    		'name'		=> 'unique:products|required'
    		]);
    	}

    	P::where(['id'=>$id])->update([
    		'barcode'		=> $request->barcode,
    		'name'			=> $request->name,
    		'price'			=> $request->price,
    		'category'		=> $request->category
    	]);

    	return redirect()->route('products', $request->category)->with('success', 'berhasil diubah');
    }

    public function editstock($category, $id)
    {
    	$oper = array(
            'title'     => 'Ubah Stok Produk'.title(),
            'modul'     => 'product',
    		'data'		=> P::find($id),
    		'categories'	=> C::all(),
    		'category'		=> $category,
    		'action'		=> route('product.update.stock', [$category, $id]),
    		'back'			=> route('products', $category),
            'profile'       => $this->profile()
    	);
    	return view('products.editstock', $oper);
    }

    public function updatestock($category, $id, Request $request)
    {

    	$P = P::find($id);
    	$stock = $P->stock+$request->stock;
    	$valid = $stock>0;
    	if(!$valid){
    		return redirect()->back()->with('failed', 'Perubahan stok tidak valid!!!')->withInput();
    	}

    	P::where(['id'=>$id])->update([
    		'stock'		=> $stock
    	]);

    	S::create([
    		'product'		=> $id,
    		'change'		=> $request->stock
    		]
    	);

    	return redirect()->route('products', $request->category)->with('success', 'stok berhasil diubah');
    }

    public function delete(Request $request)
    {
    	P::destroy($request->id);

    	return redirect()->back()->with('success', 'berhasil dihapus');
    }

    public function recycle()
    {
        $data = DB::table('products')
                ->join('categories', 'categories.id', '=', 'products.category')
                ->select('products.*', 'categories.name as category_name')
                ->orderBy('name', 'asc')
                ->where('products.deleted_at', '!=', null)
                ->where('categories.deleted_at', '=', null)
                ->get();
        $oper = array(
            'title'         => 'Produk Dihapus'.title(),
            'modul'         => 'products_recycle',
            // 'categories'    => C::all(),
            // 'category'      => $category,
            'data'          => $data,
            // 'add'           => route('product.add', $category),
            // 'delete'        => route('product.delete', $category),
            'profile'       => $this->profile()
        );
        // dd($this->profile());
        return view('products.recycle', $oper);
    }

    public function restore(Request $request)
    {
        P::where('id',$request->id)->restore();

        return redirect()->route('products','all')->with('success', 'berhasil direstore');
    }
}

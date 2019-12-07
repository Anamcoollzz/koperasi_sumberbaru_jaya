<?php
Auth::routes();
Route::group(['middleware' => 'auth'], function() {
	Route::get('/', function(){
		$lvl = Auth::user()->level;
		if(session('success')){
			$msg = session('success');
			if($lvl==2){
				return redirect()->route('home')->with('success', $msg);
			}
			else if($lvl==3){
				return redirect()->route('transactions')->with('success', $msg);
			}
			return redirect()->route('products', 'all')->with('success', $msg);
		}
		else if(session('failed')){
			$msg = session('failed');
			if($lvl==2)
				return redirect()->route('home')->with('failed', $msg);
			else if($lvl==3)
				return redirect()->route('transactions')->with('failed', $msg);
			return redirect()->route('products', 'all')->with('failed', $msg);
		}
		if($lvl==2)
			return redirect()->route('home');
		else if($lvl==3)
			return redirect()->route('transactions');
		return redirect()->route('products', 'all');

	})->name('/');
	#Produk dihapus modul
	Route::get('/recycle/products', 'ProductController@recycle')->name('products.recycle')->middleware('adminmanager');
	Route::get('/recycle/categories', 'CategoryController@recycle')->name('categories.recycle')->middleware('adminmanager');
	Route::get('/profile/edit', 'ProfileController@edit')->name('profile.edit');
	Route::put('/profile/update', 'ProfileController@update')->name('profile.update');
	Route::put('/avatar/update', 'ProfileController@avatarupdate')->name('avatar.update');
	Route::put('/password/update', 'ProfileController@passwordupdate')->name('password.update');
	Route::put('/password/reset', 'ProfileController@reset')->name('password.reset');

	#Hak akses admin
	Route::group(['middleware' => 'admin'], function() {
		#Manager modul
		Route::get('/managers', 'ManagerController@index')->name('managers');
		Route::get('/manager/add', 'ManagerController@add')->name('manager.add');
		Route::post('/manager/create', 'ManagerController@create')->name('manager.create');
		Route::get('/manager/{id}/edit', 'ManagerController@edit')->name('manager.edit');
		Route::put('/manager/{id}/update', 'ManagerController@update')->name('manager.update');
		Route::delete('/manager/delete', 'ManagerController@delete')->name('manager.delete');
		Route::put('/manager/reset', 'ManagerController@reset')->name('manager.reset');
	
		#Cashier modul
		Route::get('/cashiers', 'CashierController@index')->name('cashiers');
		Route::get('/cashier/add', 'CashierController@add')->name('cashier.add');
		Route::post('/cashier/create', 'CashierController@create')->name('cashier.create');
		Route::get('/cashier/{id}/edit', 'CashierController@edit')->name('cashier.edit');
		Route::put('/cashier/{id}/update', 'CashierController@update')->name('cashier.update');
		Route::delete('/cashier/delete', 'CashierController@delete')->name('cashier.delete');
		Route::put('/cashier/reset', 'CashierController@reset')->name('cashier.reset');
		
		#Category modul
		Route::get('/categories', 'CategoryController@index')->name('categories');
		Route::get('/category/add', 'CategoryController@add')->name('category.add');
		Route::post('/category/create', 'CategoryController@create')->name('category.create');
		Route::get('/category/{id}/edit', 'CategoryController@edit')->name('category.edit');
		Route::post('/category/{id}/update', 'CategoryController@update')->name('category.update');
		Route::post('/category/delete', 'CategoryController@delete')->name('category.delete');
		Route::post('/category/restore', 'CategoryController@restore')->name('category.restore');

		#Product modul
		Route::get('/products/{category}', 'ProductController@index')->name('products');
		Route::get('/product/{category}/add', 'ProductController@add')->name('product.add');
		Route::post('/product/{category}/create', 'ProductController@create')->name('product.create');
		Route::get('/product/{category}/{id}/edit', 'ProductController@edit')->name('product.edit');
		Route::put('/product/{category}/{id}/update', 'ProductController@update')->name('product.update');
		Route::get('/product/{category}/{id}/stock/edit', 'ProductController@editstock')->name('product.edit.stock');
		Route::put('/product/{category}/{id}/stock/update', 'ProductController@updatestock')->name('product.update.stock');
		Route::delete('/product/{category}/delete', 'ProductController@delete')->name('product.delete');
		Route::post('/product/restore', 'ProductController@restore')->name('product.restore');

		Route::get('/backup', 'BackupController@index')->name('backup');
	});

	#Hak akses manajer
	Route::group(['middleware' => 'manager'], function() {

		Route::get('/home', 'HomeController@index')->name('home');

		#Laporan penjualan modul
		Route::get('/report/products/{time}', 'ReportController@products')->name('report.products');
		Route::get('/report/products/{month}/{year}', 'ReportController@productsDetail')->name('report.products.detail');
		Route::get('/report/products', 'ReportController@product')->name('rp');
		Route::get('/print/products/{time}', 'ReportController@printproducts')->name('print.products');
		Route::get('/print/products/{month}/{year}', 'ReportController@printproductsDetail')->name('print.products.detail');
	});

	#Hak akses kasir
	Route::group(['middleware' => 'cashier'], function() {
		#Transaction modul
		Route::get('/transactions', 'TransactionController@index')->name('transactions');
		Route::get('/transaction/add', 'TransactionController@add')->name('transaction.add');
		Route::post('/transaction/create', 'TransactionController@create')->name('transaction.create');
		Route::post('/transaction/price/check', 'TransactionController@checkprice')->name('check.price');
		Route::get('/transaction/struct/{id}/print', 'TransactionController@printstruct')->name('print.struct');
		Route::post('/transaction/{id}/detail', 'TransactionController@detail')->name('transaction.detail');
	});
});

<?php

use Illuminate\Database\Seeder;
// use Schema;
use App\User;
use App\Cashier;
use App\Manager;

class ResetUserToDefault extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	User::updateOrCreate([
    		'username'=>'admin',
    	],[
    		'password'=>md5('admin'),
    		'level'=>'1'
    	]);
    	User::updateOrCreate([
    		'username'=>'kasir',
    	],[
    		'password'=>md5('kasir'),
    		'level'=>'3'
    	]);
    	User::updateOrCreate([
    		'username'=>'manajer',
    	],[
    		'password'=>md5('manajer'),
    		'level'=>'2'
    	]);

    	foreach(DB::table('logins')->where('level', '3')->get() as $a){
    		Cashier::updateOrCreate([
    			'login'=>$a->id,
    		],[
    			'name'=>'Hairul Anam',
    			'email'=>'hairulanam21@gmail.com',
    			'phone_number'=>'085322778935',
    			'gender'=>'Laki-laki',
    			'city'=>'Jember',
    			'birthdate'=>'2000-01-01',
    			'address'=>'Tanggul Kulon',
    		]);
    	}

    	foreach(DB::table('logins')->where('level', '2')->get() as $a){
    		Manager::updateOrCreate([
    			'login'=>$a->id,
    		],[
    			'name'=>'Muhammad Yusuf Auliya',
    			'email'=>'yusuf12@gmail.com',
    			'phone_number'=>'089234567890',
    			'gender'=>'Laki-laki',
    			'city'=>'Kediri',
    			'birthdate'=>'1945-08-17',
    			'address'=>'Nusa Barong',
		// 'login'=>$a->id,
    		]);
    	}
    }
}

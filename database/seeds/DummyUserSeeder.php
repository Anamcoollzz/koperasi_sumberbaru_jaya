<?php

use Illuminate\Database\Seeder;

class DummyUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('logins')->insert([
        	'username'	=> 'admin',
        	'password'	=> md5('admin'),
        	'level'		=> 1
        ]);
        DB::table('logins')->insert([
        	'username'	=> 'kasir',
        	'password'	=> md5('kasir'),
        	'level'		=> 3
        ]);
        DB::table('logins')->insert([
        	'username'	=> 'manajer',
        	'password'	=> md5('manajer'),
        	'level'		=> 2
        ]);
    }
}

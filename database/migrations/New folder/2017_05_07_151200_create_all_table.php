<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAllTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logins', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('username')->unique();
            $table->string('password');
            $table->integer('level');
        });

        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name')->unique();
        });

        Schema::create('products', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('barcode')->unique();
            $table->string('name')->unique();
            $table->integer('category')->unsigned();
            $table->integer('stock');
            $table->integer('price');
            $table->integer('sell_price');
        });

        Schema::create('cashiers', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->string('email');
            $table->string('phone_number');
            $table->string('gender');
            $table->string('city');
            $table->date('birthdate');
            $table->string('address');
            $table->integer('login')->unsigned()->unique();
        });

        Schema::create('managers', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->string('gender');
            $table->string('email');
            $table->string('phone_number');
            $table->string('city');
            $table->date('birthdate');
            $table->string('address');
            $table->integer('login')->unsigned()->unique();
        });

        // Schema::create('stock_changes', function (Blueprint $table) {
        //     $table->increments('id')->unsigned();
        //     $table->integer('product')->unsigned();
        //     $table->integer('change');
        //     $table->timestamp('created_at');
        // });

        Schema::create('transactions', function(Blueprint $table){
            $table->increments('id')->unsigned();
            $table->string('nota');
            $table->dateTime('created_at');
            $table->integer('payin');
            $table->integer('cashier')->unsigned();
        });

        Schema::create('detail_transactions', function(Blueprint $table){
            $table->increments('id')->unsigned();
            $table->integer('product')->unsigned();
            $table->integer('price');
            $table->integer('quantity');
            $table->integer('transaction')->unsigned();
            $table->integer('sell_price');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->foreign('category')->references('id')->on('categories');
        });
        Schema::table('cashiers', function (Blueprint $table) {
            $table->foreign('login')->references('id')->on('logins');
        });
        Schema::table('managers', function (Blueprint $table) {
            $table->foreign('login')->references('id')->on('logins');
        });
        // Schema::table('stock_changes', function (Blueprint $table) {
        //     $table->foreign('product')->references('id')->on('products');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['category']);
        });
        Schema::table('cashiers', function (Blueprint $table) {
            $table->dropForeign(['login']);
        });
        Schema::table('managers', function (Blueprint $table) {
            $table->dropForeign(['login']);
        });
        // Schema::table('stock_changes', function (Blueprint $table) {
        //     $table->dropForeign(['product']);
        // });
        Schema::dropIfExists('logins');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('products');
        Schema::dropIfExists('cashiers');
        Schema::dropIfExists('managers');
        // Schema::dropIfExists('stock_changes');
        Schema::dropIfExists('transactions');
        Schema::dropIfExists('detail_transactions');
    }
}


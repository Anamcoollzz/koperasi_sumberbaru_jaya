<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePesanan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesanan', function (Blueprint $table) {
            $table->increments('id_pesanan');
            $table->string('username');
            $table->date('tgl_sewa');
            $table->date('tgl_setelah_sewa');
            $table->string('lokasi_customer');
            $table->string('sopir');
            $table->integer('harga');
            $table->integer('id_mobil');
            $table->foreign('id_mobil')->references('id_mobil')->on('mobil');
            $table->foreign('username')->references('username')->on('profilop');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pesanan');
    }
}

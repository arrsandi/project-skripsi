<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiPengirimanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_pengiriman', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('user_id');
            $table->string('noinvoice');
            $table->dateTime('tanggal');
            $table->string('nama_pengirim');
            $table->string('alamat_pengirim');
            $table->string('telepon_pengirim', 20);
            $table->bigInteger('total_biaya')->default('0');
            $table->bigInteger('potongan')->default('0');
            $table->bigInteger('total_biaya_keseluruhan')->default('0');
            $table->string('status_pengiriman', 30);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi_pengiriman');
    }
}

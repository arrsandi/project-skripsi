<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailTransaksiPengirimanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_transaksi_pengiriman', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('transaksi_id');
            $table->string('nama_penerima');
            $table->string('telepon_penerima', 20);
            $table->string('alamat_penerima');
            $table->integer('biaya_pengiriman_id');
            $table->string('nama_kapal')->nullable();
        $table->bigInteger('biaya_kirim')->default('0');
            $table->bigInteger('biaya_koordinasi')->default('0');
            $table->bigInteger('biaya_tambahan')->default('0');
            $table->string('merk_type');
            $table->string('warna');
            $table->string('no_polisi')->nullable();
            $table->string('no_rangka');
            $table->string('no_mesin');
            $table->string('keterangan')->nullable();
            $table->bigInteger('total_biaya_per_unit')->default('0');
            $table->timestamps();

            $table->foreign('transaksi_id')->references('id')->on('transaksi_pengiriman')->onDelete('cascade');
            $table->foreign('biaya_pengiriman_id')->references('id')->on('biaya_pengiriman');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_transaksi_pengiriman');
    }
}

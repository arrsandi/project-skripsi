<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBiayaPengirimanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('biaya_pengiriman', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('unit_id');
            $table->string('rute_asal');
            $table->string('rute_tujuan');
            $table->bigInteger('biaya_pengiriman')->default('0');
            $table->integer('jenis_pengiriman_id');
            $table->timestamps();

            $table->foreign('unit_id')->references('id')->on('unit');
            $table->foreign('jenis_pengiriman_id')->references('id')->on('jenis_pengiriman');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('biaya_pengiriman');
    }
}

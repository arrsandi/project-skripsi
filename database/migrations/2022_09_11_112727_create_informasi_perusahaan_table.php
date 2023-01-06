<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInformasiPerusahaanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('informasi_perusahaan', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('nama_perusahaan');
            $table->text('deskripsi_perusahaan');
            $table->string('telepon_perusahaan');
            $table->string('email_perusahaan');
            $table->string('alamat_perusahaan');
            $table->text('cover');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('informasi_perusahaan');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePemesanansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemesanans', function (Blueprint $table) {
            $table->string('no_pemesanan',15)->primary();
            // $table->unsignedInteger('id_user')->nullable();
            $table->string('no_meja_pemesanan',15);
            $table->date('tgl_pemesanan');
            $table->integer('ttl_hrg_pemesanan');
            $table->enum('status_pembayaran',['belum','sudah'])->default('belum');
            $table->enum('status_pemesanan',['open','close'])->default('open');
            $table->timestamps();
            $table->softDeletes();

            // $table->foreign('id_user')->references('id_user')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pemesanans');
    }
}

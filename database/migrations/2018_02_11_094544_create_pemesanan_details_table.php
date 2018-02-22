<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePemesananDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemesanan_details', function (Blueprint $table) {
            $table->increments('id_no_pemesanan_detail');
            $table->string('no_pemesanan',15); // FK
            $table->unsignedInteger('id_menu');
            $table->integer('subtotal');
            $table->tinyInteger('qty');
            $table->timestamps();

            $table->foreign('id_menu')->references('id_menu')->on('daftar_menus')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pemesanan_details');
    }
}

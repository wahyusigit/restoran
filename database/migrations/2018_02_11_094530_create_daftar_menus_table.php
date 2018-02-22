<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDaftarMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daftar_menus', function (Blueprint $table) {
            $table->increments('id_menu');
            $table->string('nama_menu',32);
            $table->string('desk_menu');
            $table->enum('jenis_menu',['makanan','minuman']);
            $table->integer('harga');
            $table->enum('status_menu',['ready','not ready'])->default('ready');
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
        Schema::dropIfExists('daftar_menus');
    }
}

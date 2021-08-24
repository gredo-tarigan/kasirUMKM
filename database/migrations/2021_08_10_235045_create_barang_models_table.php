<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang_models', function (Blueprint $table) {
            $table->id();
            //$table->string('kode_barang')->unique();
            $table->string('slug')->unique(); // nantinya slug ini ga di database tp jadi otomatis tergenerate
            $table->string('nama_barang');
            $table->integer('hargamasuk_barang');
            $table->integer('hargajual_barang');
            $table->decimal('stok_barang');
            //$table->string('diupdateoleh_barang');

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
        Schema::dropIfExists('barang_models');
    }
}

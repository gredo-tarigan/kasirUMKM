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
            $table->id()->unique();
            //$table->string('kode_barang')->unique();
            $table->string('nama_barang');
            $table->string('supplier_barang')->nullable();
            $table->string('ket_barang')->nullable();
            $table->string('kategori_barang')->nullable();
            $table->string('kategorijual_barang')->nullable();
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

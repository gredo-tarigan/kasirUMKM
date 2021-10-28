<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->id()->unique();
            $table->foreignId('kategori_penjualan_id');
            // $table->foreignId('kategori_barang_id');
            $table->string('nama');
            $table->string('supplier')->nullable();
            $table->string('keterangan')->nullable();
            $table->integer('harga_masuk');
            $table->integer('harga_jual');
            $table->decimal('stok');

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
        Schema::dropIfExists('barangs');
    }
}

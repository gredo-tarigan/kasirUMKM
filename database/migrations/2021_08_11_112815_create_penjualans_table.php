<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenjualansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penjualans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('barang_id');
            $table->foreignId('kategori_penjualan_id');
            $table->foreignId('akun_id');
            $table->integer('sub_total');
            $table->integer('harga_jadi');
            $table->integer('massa_pieces'); // untuk ngubungin ke stok terus ntar dikurangin
            $table->string('nota_id'); // di temp_penjualan gada nota_id

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
        Schema::dropIfExists('penjualans');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockOpnamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_opnames', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->decimal('stok_awal');
            $table->decimal('stok_sistem');
            $table->decimal('stok_fisik');
            $table->decimal('stok_masuk');
            $table->decimal('stok_keluar');
            $table->foreignId('barang_id');
            $table->string('keterangan');
            $table->date('opname_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock_opnames');
    }
}

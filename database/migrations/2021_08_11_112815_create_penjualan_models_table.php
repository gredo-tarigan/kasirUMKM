<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenjualanModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penjualan_models', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique(); // nantinya slug ini ga di database tp jadi otomatis tergenerate
            $table->string('namabarang_penjualan');
            $table->string('jenis_pengeluaran');
            $table->integer('total_pengeluaran');
            $table->decimal('massabarang_penjualan');
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
        Schema::dropIfExists('penjualan_models');
    }
}

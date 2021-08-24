<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengeluaranModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengeluaran_models', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique(); // nantinya slug ini ga di database tp jadi otomatis tergenerate
            $table->string('ket_pengeluaran');
            $table->string('jenis_pengeluaran');
            $table->int('nominal_pengeluaran');
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
        Schema::dropIfExists('pengeluaran_models');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAkunModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('akun_models', function (Blueprint $table) {
            $table->string('nama_ak');
            $table->string('alamat_ak');
            $table->string('tptlahir_ak');
            $table->date('tgllahir_ak');

            $table->string('jabatan_ak')->default('Kasir');
            $table->enum('jk_ak', ['Laki-Laki', 'Perempuan']);
            $table->string('username')->unique();
            $table->string('password');
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
        Schema::dropIfExists('akun_models');
    }
}

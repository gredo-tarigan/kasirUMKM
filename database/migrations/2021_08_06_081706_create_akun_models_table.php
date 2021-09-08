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
            $table->id()->unique();
            $table->string('username')->unique();
            $table->string('password');
            $table->string('nama_akun');
            $table->integer('noHp_akun');
            $table->string('alamat_akun');
            $table->integer('tipe_akun');

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

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMakulsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('makuls', function (Blueprint $table) {
            $table->id();
            $table->string('kode_makul');
            $table->string('nama_makul');
            $table->string('prodi');
            $table->string('kelas');
            $table->string('nama_dosen');
            $table->integer('sks_teori')->nullable();
            $table->integer('sks_praktek')->nullable();
            $table->string('ruangan', 50);
            $table->string('hari')->nullable();
            $table->time('jam')->nullable();
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
        Schema::dropIfExists('makuls');
    }
}

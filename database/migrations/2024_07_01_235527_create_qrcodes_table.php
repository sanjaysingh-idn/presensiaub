<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQrcodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qrcodes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_makul');
            $table->foreignId('author')->constrained('users');
            $table->text('kode_makul');
            $table->text('nama_makul');
            $table->text('prodi');
            $table->text('kelas');
            $table->text('dosen');
            $table->text('ruangan');
            $table->text('hari');
            $table->time('jam');
            $table->text('qrcode');
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
        Schema::dropIfExists('qrcodes');
    }
}

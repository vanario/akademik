<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Ekstrakurikuler extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('ekstrakurikuler', function (Blueprint $table) {
            $table->increments('id');            
            $table->string('kode_ekstrak')->nullable();
            $table->integer('nis')->nullable();
            $table->integer('nama_siswa')->nullable();
            $table->integer('kelas_id')->nullable();
            $table->string('nama_ekstrak')->nullable();
            $table->integer('nilai')->nullable();
            $table->integer('semester_id')->nullable();
            $table->integer('tahun_ajaran_id')->nullable();
            $table->string('keterangan')->nullable();
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
        Schema::dropIfExists('ekstrakurikuler');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColoumnTableSiswa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('siswa', function (Blueprint $table) {
    
        $table->integer('nis')->nullable();
        $table->integer('nisn')->nullable();
        $table->date('tanggal_lahir')->nullable();
        $table->string('tempat_lahir')->nullable();
        $table->string('agama')->nullable();
        $table->string('jenis Kelamin')->nullable();
        $table->string('kelas')->nullable();
        $table->string('nama_ayah')->nullable();
        $table->string('pekerjaan_ayah')->nullable();
        $table->string('nama_ibu')->nullable();
        $table->string('pekerjaan_ibu')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('siswa', function (Blueprint $table) {
            //
        });
    }
}

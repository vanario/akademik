<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePresensiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presensi', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('siswa_id')->nullable();
            $table->integer('alpa')->nullable();
            $table->integer('sakit')->nullable();
            $table->integer('izin')->nullable();
            $table->integer('kelas_id')->nullable();
            $table->integer('semeseter_id')->nullable();
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
        Schema::dropIfExists('presensi');
    }
}

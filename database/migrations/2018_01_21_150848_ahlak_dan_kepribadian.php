<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AhlakDanKepribadian extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ahlak_dan_kepribadian', function (Blueprint $table) {
            $table->increments('id');            
            $table->string('kode_kepribadian')->nullable();
            $table->integer('nis')->nullable();
            $table->integer('nama_siswa')->nullable();
            $table->integer('kelas_id')->nullable();
            $table->string('Ahlak')->nullable();
            $table->string('Kepribadian')->nullable();
            $table->integer('tahun_ajaran_id')->nullable();
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
        Schema::dropIfExists('ahlak_dan_kepribadian');
    }
}

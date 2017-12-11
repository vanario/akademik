<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNilaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilai', function (Blueprint $table) {
            $table->increments('id');            
            $table->integer('mata_pelajaran_id')->nullable();
            $table->integer('siswa_id')->nullable();
            $table->float('nilai')->nullable();
            $table->string('ketarangan')->nullable();
            $table->integer('kelas_id')->nullable();
            $table->integer('semeseter_id')->nullable();
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
        Schema::dropIfExists('nilai');
    }
}

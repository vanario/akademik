<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePengampuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengampu', function (Blueprint $table) {
            $table->increments('id');            
            $table->integer('guru_id')->nullable();
            $table->integer('mapel_id')->nullable();
            $table->integer('kelas_id')->nullable();
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
        Schema::dropIfExists('pengampu');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColoumnNilaiSiswa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        Schema::table('nilai', function (Blueprint $table) {

        $table->float('ulangan_harian1')->nullable();
        $table->float('ulangan_harian2')->nullable();
        $table->float('ulangan_harian3')->nullable();
        $table->float('ujian_praktik')->nullable();
        $table->float('nilai_tugas1')->nullable();
        $table->float('nilai_tugas2')->nullable();
        $table->float('nilai_tugas3')->nullable();
        $table->float('uts')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('nilai', function (Blueprint $table) {
            //
        });
    }
}

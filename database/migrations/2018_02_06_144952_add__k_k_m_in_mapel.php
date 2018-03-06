<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddKKMInMapel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mappel', function (Blueprint $table) {
            //
        $table->string('kkm')->nullable();
        });
    }

    public function down()
    {
        Schema::table('mappel', function (Blueprint $table) {
            //
        });
    }
}

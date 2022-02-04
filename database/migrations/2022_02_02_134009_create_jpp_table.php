<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJppTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jpps', function (Blueprint $table) {
            $table->id();
            $table->string('kodeCounter');
            $table->string('jenisJasper');
            $table->string('latitude');
            $table->string('longtitude');
            $table->string('penanggungJawab');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jpps');
    }
}

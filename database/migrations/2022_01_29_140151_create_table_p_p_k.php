<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePPK extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ppks', function (Blueprint $table) {
            $table->integer('id_ppk');
            $table->primary('id_ppk');
            $table->string('no_ppk', 100);
            $table->string('no_aju_ppk', 100);
            $table->string('nm_trader', 100);
            $table->integer('jumlah');
            $table->integer('satuan');
            $table->string('status', 50);
            $table->string('nm_penerima', 50);
            $table->integer('id_trader');
            $table->foreign('id_trader')->references('id_trader')->on('traders');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ppks');
    }

}

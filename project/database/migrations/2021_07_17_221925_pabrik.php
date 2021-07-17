<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Pabrik extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mstr_pabrik', function (Blueprint $table) {
            $table->integerIncrements('id_pabrik');
            $table->string('nama_pabrik');
            $table->string('kode_pabrik');
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
        Schema::dropIfExists('mstr_pabrik');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Petani extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mstr_petani', function (Blueprint $table) {
            $table->integerIncrements('id_petani');
            $table->string('reg');
            $table->string('nama_petani');
            $table->integer('id_pabrik');
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
        Schema::dropIfExists('mstr_petani');
    }
}

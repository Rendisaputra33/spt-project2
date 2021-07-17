<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Entry extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entry', function (Blueprint $table) {
            $table->integerIncrements('id_entry');
            $table->integer('periode');
            $table->integer('masa_giling');
            $table->integer('id_pabrik');
            $table->string('reg');
            $table->string('nospta');
            $table->string('nopol');
            $table->integer('bobot');
            $table->integer('variasi');
            $table->integer('type');
            $table->text('keterangan');
            $table->double('harga_beli');
            $table->double('hpp');
            $table->double('sisa');
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
        Schema::dropIfExists('entry');
    }
}

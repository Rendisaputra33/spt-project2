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
            $table->string('periode');
            $table->integer('masa_giling');
            $table->integer('id_pabrik');
            $table->string('pabrik');
            $table->string('reg');
            $table->string('petani');
            $table->string('nospta');
            $table->string('nopol');
            $table->integer('bobot');
            $table->integer('variasi');
            $table->string('variasi_');
            $table->integer('type');
            $table->string('type_');
            $table->text('keterangan')->nullable();
            $table->double('harga_beli')->nullable();
            $table->double('hpp')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
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

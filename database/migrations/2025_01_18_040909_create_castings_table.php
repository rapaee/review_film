<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('castings', function (Blueprint $table) {
            $table->increments('id_castings');
            $table->string('nama_panggung');
            $table->string('nama_alsi');
            $table->integer('id_film')->unsigned();
            $table->timestamps();

            $table->foreign('id_film')->references('id_film')->on('film');
        });
    }

    public function down()
    {
        Schema::dropIfExists('castings');
    }
};

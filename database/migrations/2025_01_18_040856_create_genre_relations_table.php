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
        Schema::create('genre_relations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_film')->unsigned();
            $table->integer('id_genre')->unsigned();
            $table->timestamps();

            $table->foreign('id_film')->references('id_film')->on('film');
            $table->foreign('id_genre')->references('id_genre')->on('genre');
        });
    }

    public function down()
    {
        Schema::dropIfExists('genre_relations');
    }
};

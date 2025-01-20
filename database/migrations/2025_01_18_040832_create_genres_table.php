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
        Schema::create('genre', function (Blueprint $table) {
            $table->increments('id_genre');
            $table->string('title');
            $table->string('slug');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('genre');
    }
};

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
            $table->string('nama_asli');
            $table->timestamps();

        });
    }

    public function down()
    {
        Schema::dropIfExists('castings');
    }
};

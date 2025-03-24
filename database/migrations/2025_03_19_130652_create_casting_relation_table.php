<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('casting_relation', function (Blueprint $table) {
            $table->id();
            $table->integer('id_casting')->unsigned();
            $table->integer('id_film')->unsigned();
            $table->foreign('id_casting')->references('id_castings')->on('castings')->onDelete('cascade');
            $table->foreign('id_film')->references('id_film')->on('film')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('casting_relation');
    }
};

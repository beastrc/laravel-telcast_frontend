<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGenreablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('genreables', function (Blueprint $table) {
            $table->id();
            $table->foreignId('genre_id')->references('id')->on('genres')->onDelete('cascade');
            $table->unsignedBigInteger('genreable_id');
            $table->string('genreable_type');
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
        Schema::dropIfExists('genreables');
    }
}

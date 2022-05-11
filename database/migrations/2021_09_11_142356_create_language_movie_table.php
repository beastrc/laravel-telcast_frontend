<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLanguageMovieTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('language_movie', function (Blueprint $table) {
            $table->id();
	        $table->foreignId('language_id')->references('id')->on('languages')->onDelete('cascade');
	        $table->foreignId('movie_id')->references('id')->on('movies')->onDelete('cascade');
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
        Schema::dropIfExists('language_movie');
    }
}

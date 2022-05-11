<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediaMovieTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media_movie', function (Blueprint $table) {
            $table->id();
	        $table->foreignId('media_id')->references('id')->on('media')->onDelete('cascade');
	        $table->foreignId('movie_id')->references('id')->on('movies')->onDelete('cascade');
	        $table->string('type');
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
        Schema::dropIfExists('media_movie');
    }
}

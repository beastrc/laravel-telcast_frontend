<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediaSportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media_sport', function (Blueprint $table) {
            $table->id();
            $table->foreignId('media_id')->references('id')->on('media')->onDelete('cascade');
            $table->foreignId('sport_id')->references('id')->on('sports')->onDelete('cascade');
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
        Schema::dropIfExists('media_sport');
    }
}

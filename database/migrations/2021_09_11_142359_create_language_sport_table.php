<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLanguageSportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('language_sport', function (Blueprint $table) {
            $table->id();
	        $table->foreignId('language_id')->references('id')->on('languages')->onDelete('cascade');
	        $table->foreignId('sport_id')->references('id')->on('sports')->onDelete('cascade');
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
        Schema::dropIfExists('language_sport');
    }
}

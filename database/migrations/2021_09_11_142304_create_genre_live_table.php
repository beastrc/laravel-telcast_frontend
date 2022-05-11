<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGenreLiveTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('genre_live', function (Blueprint $table) {
            $table->id();
	        $table->foreignId('genre_id')->references('id')->on('genres')->onDelete('cascade');
	        $table->foreignId('live_id')->references('id')->on('lives')->onDelete('cascade');
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
        Schema::dropIfExists('genre_live');
    }
}

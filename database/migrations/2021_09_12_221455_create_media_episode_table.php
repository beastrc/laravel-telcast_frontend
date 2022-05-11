<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediaEpisodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media_episode', function (Blueprint $table) {
            $table->id();
            $table->foreignId('media_id')->references('id')->on('media')->onDelete('cascade');
            $table->foreignId('episode_id')->references('id')->on('episodes')->onDelete('cascade');
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
        Schema::dropIfExists('media_episode');
    }
}

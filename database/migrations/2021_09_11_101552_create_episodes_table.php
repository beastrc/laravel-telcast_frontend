<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEpisodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('episodes', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('channel_id')->references('id')->on('channels')->onDelete('cascade');
            $table->string('channel_id');
            $table->foreignId('show_id')->references('id')->on('shows');
	        $table->foreignId('season_id')->references('id')->on('seasons');
	        $table->string('title');
	        $table->text('description');
	        $table->string('imdb_rating');
	        $table->string('content_rating');
	        $table->date('release_date');
	        $table->string('meta_title')->nullable();
	        $table->text('meta_description')->nullable();
	        $table->text('meta_keywords')->nullable();
	        $table->boolean('download')->default(0);
	        $table->boolean('subtitles')->default(0);
	        $table->boolean('upcoming')->default(0);
	        $table->boolean('premium')->default(0);
	        $table->boolean('status')->default(1);
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
        Schema::dropIfExists('episodes');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lives', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('channel_id')->references('id')->on('channels')->onDelete('cascade');
            $table->string('channel_id');
            $table->string('title');
            $table->text('description');
            $table->json('actors');
            $table->json('directors');
            $table->string('content_rating');
            $table->date('release_date');
            $table->text('type');
            $table->text('url');
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
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
        Schema::dropIfExists('lives');
    }
}

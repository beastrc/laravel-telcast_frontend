<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeasonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seasons', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('channel_id')->references('id')->on('channels')->onDelete('cascade');
            $table->string('channel_id');
            $table->foreignId('show_id')->references('id')->on('shows');
            $table->string('title');
            $table->text('description');
	        $table->string('meta_title')->nullable();
	        $table->text('meta_description')->nullable();
	        $table->text('meta_keywords')->nullable();
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
        Schema::dropIfExists('seasons');
    }
}

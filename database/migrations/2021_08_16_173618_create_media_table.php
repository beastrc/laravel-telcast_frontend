<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('channel_id')->references('id')->on('channels')->onDelete('cascade');
            $table->string('channel_id');
            $table->string('title');
            $table->string('type');
            $table->string('size');
            $table->string('extension');
            $table->string('duration')->nullable();
            $table->string('path');
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
        Schema::dropIfExists('media');
    }
}

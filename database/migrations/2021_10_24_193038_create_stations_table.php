<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stations', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            // $table->foreignId('channel_id')->references('id')->on('channels')->onDelete('cascade');
            $table->string('user_id');
            $table->string('channel_id');
            $table->string('title');
            $table->string('logo');
            $table->string('country');
            $table->string('state');
            $table->string('county');
            $table->string('type');
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
        Schema::dropIfExists('stations');
    }
}

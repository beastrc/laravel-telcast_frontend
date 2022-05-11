<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('likes', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->unsignedBigInteger('likeable_id');
            $table->string('likeable_type');
            $table->string('ip_address')->nullable();
            $table->string('user_agent')->nullable();
            $table->bigInteger('liked')->nullable();
            $table->bigInteger('disliked')->nullable();
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
        Schema::dropIfExists('likes');
    }
}

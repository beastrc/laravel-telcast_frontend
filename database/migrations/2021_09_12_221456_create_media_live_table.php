<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediaLiveTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media_live', function (Blueprint $table) {
            $table->id();
            $table->foreignId('media_id')->references('id')->on('media')->onDelete('cascade');
            $table->foreignId('live_id')->references('id')->on('lives')->onDelete('cascade');
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
        Schema::dropIfExists('media_live');
    }
}

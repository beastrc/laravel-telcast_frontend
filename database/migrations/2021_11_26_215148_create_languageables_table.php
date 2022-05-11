<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLanguageablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('languageables', function (Blueprint $table) {
            $table->id();
            $table->foreignId('language_id')->references('id')->on('languages')->onDelete('cascade');
            $table->unsignedBigInteger('languageable_id');
            $table->string('languageable_type');
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
        Schema::dropIfExists('languageables');
    }
}

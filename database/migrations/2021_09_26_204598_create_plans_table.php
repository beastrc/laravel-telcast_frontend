<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
	        $table->id();
	        $table->string('title');
	        $table->decimal('price');
	        $table->decimal('price_discount');
	        $table->decimal('price_annual');
	        $table->decimal('price_annual_discount');
	        $table->json('features');
	        $table->boolean('status')->default(0);
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
        Schema::dropIfExists('plans');
    }
}

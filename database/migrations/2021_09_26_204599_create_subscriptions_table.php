<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
	        $table->id();
	        // $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
	        // $table->foreignId('channel_id')->references('id')->on('channels')->onDelete('cascade');
	        $table->string('user_id');
	        $table->string('channel_id');            
            $table->decimal('price');
	        $table->timestamp('expired_at')->nullable();
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
        Schema::dropIfExists('subscriptions');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
	        $table->id();
	        // $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
	        // $table->foreignId('channel_id')->references('id')->on('channels')->onDelete('cascade');
	        $table->string('user_id');
	        $table->string('channel_id');
            $table->string('txn_id')->index();
	        $table->decimal('amount');
	        $table->string('currency');
	        $table->string('method');
	        $table->boolean('status')->default(2);  // Pending=2, Active=1, Cancelled=0
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
        Schema::dropIfExists('transactions');
    }
}

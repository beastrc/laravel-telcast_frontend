<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdCampaignChannelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ad_campaign_channel', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('ad_campaign_id')->references('id')->on('ad_campaigns')->onDelete('cascade');
            // $table->foreignId('channel_id')->references('id')->on('channels')->onDelete('cascade');
            $table->string('ad_campaign_id');
            $table->foreignId('channel_id');
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
        Schema::dropIfExists('ad_campaign_channel');
    }
}

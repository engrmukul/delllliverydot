<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiderSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     * ONLY FOR FIREBASE CONFIGURATION
     */

    public function up()
    {
        Schema::create('rider_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('rider_id')->references('id')->on('riders')->onDelete('cascade');
            $table->enum('notification', ['1','0'])->default('1');
            $table->enum('popup_notification', ['1','0'])->default('1');
            $table->enum('sms', ['1','0'])->default('1');
            $table->enum('offer_and_promotion', ['1','0'])->default('1');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rider_settings');
    }
}

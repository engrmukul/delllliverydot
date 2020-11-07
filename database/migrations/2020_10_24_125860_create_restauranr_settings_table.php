<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestaurantSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     * ONLY FOR FIREBASE CONFIGURATION
     */

    public function up()
    {
        Schema::create('restaurant_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('restaurant_id')->references('id')->on('restaurants')->onDelete('cascade');
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
        Schema::dropIfExists('restaurant_settings');
    }
}

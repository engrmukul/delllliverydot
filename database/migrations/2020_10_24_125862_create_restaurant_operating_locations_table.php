<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestaurantOperatingLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     * ONLY FOR FIREBASE CONFIGURATION
     */

    public function up()
    {
        Schema::create('restaurant_operating_locations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('restaurant_id')->references('id')->on('restaurant')->onDelete('cascade');
            $table->longText('address');
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
        Schema::dropIfExists('restaurant_operating_locations');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestaurantProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurant_profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('restaurant_id')->references('id')->on('restaurants')->onDelete('cascade');
            $table->string('name', 100)->nullable();
            $table->string('nid', 20)->nullable();
            $table->string('trade_licence', 30)->nullable();
            $table->enum('delivery_type', ['home','collect'])->default('home');
            $table->double('delivery_fee')->default(0.00);
            $table->string('delivery_time')->default('30 min');
            $table->float('discount')->default(0.00);
            $table->integer('delivery_range')->default(5);
            $table->string('mobile',20)->nullable();
            $table->text('address')->nullable();
            $table->string('latitude', 15)->nullable();
            $table->string('longitude', 15)->nullable();
            $table->enum('closed_restaurant', ['1','0'])->default('1');
            $table->enum('available_for_delivery', ['1','0'])->default('1');
            $table->foreignId('feature_section')->references('id')->on('app_home_screen_layout_settings')->onDelete('cascade');
            $table->integer('sn')->nullable();
            $table->string('image', 150)->nullable();
            $table->text('description')->nullable();
            $table->text('information')->nullable();
            $table->text('options')->nullable()->comment('json attributes add in future');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('restaurant_profiles');
    }
}

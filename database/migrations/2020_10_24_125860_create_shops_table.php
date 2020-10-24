<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     * ONLY FOR FIREBASE CONFIGURATION
     */

    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100);
            $table->enum('delivery_type', ['home','collect'])->default('home');
            $table->double('delivery_fee')->default(0.00);
            $table->string('delivery_time')->default('30 min');
            $table->float('discount')->default(0.00);
            $table->integer('delivery_range')->default(5);
            $table->string('mobile',14);
            $table->text('address');
            $table->string('latitude', 15);
            $table->string('longitude', 15);
            $table->enum('closed_shop', ['1','0'])->default('1');
            $table->enum('available_for_delivery', ['1','0'])->default('1');
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
        Schema::dropIfExists('shops');
    }
}

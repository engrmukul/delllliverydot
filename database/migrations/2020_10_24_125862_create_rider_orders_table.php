<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiderOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     * ONLY FOR FIREBASE CONFIGURATION
     */

    public function up()
    {
        Schema::create('rider_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreignId('rider_id')->references('id')->on('riders')->onDelete('cascade');
            $table->dateTime('ride_date');
            $table->enum('status', ['accept','cancel','in_restaurant','delivered'])->default(NULL);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rider_orders');
    }
}

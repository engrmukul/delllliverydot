<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreignId('food_id')->references('id')->on('foods')->onDelete('cascade');
            $table->foreignId('food_variant_id')->references('id')->on('food_variants')->onDelete('cascade');
            $table->double('food_price', 8,2)->default(0.00);
            $table->string('food_quantity', 5)->default(1);
            $table->foreignId('extra_id')->references('id')->on('extras')->onDelete('cascade');
            $table->double('extra_price',8,2)->default(0.00);
            $table->double('sub_total', 8,2)->default(0.00);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_details');
    }
}

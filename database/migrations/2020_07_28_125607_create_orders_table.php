<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->text('delivery_address');
            $table->timestamp('order_date');
            $table->enum('order_status', ['order_received','preparing','ready','on_the_way','delivered'])->default('order_received');
            $table->enum('payment_method', ['cash_on_delivery','bKash','visa','amex','master','redeem_point'])->default('cash_on_delivery');
            $table->enum('payment_status', ['waiting_for_customer','not_paid','paid'])->default('waiting_for_customer');
            $table->double('total_price',8,2)->default(0.00);
            $table->float('discount',8,2)->default(0.00);
            $table->float('vat',8,2)->default(0.00);
            $table->string('delivery_fee', 20)->default('free');
            $table->text('instructions')->nullable();
            $table->foreignId('restaurant_id')->references('id')->on('restaurants')->onDelete('cascade');
            $table->string('coupon_code',10)->default(NULL);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}

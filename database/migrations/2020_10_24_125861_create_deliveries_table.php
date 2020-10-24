<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     * ONLY FOR FIREBASE CONFIGURATION
     */

    public function up()
    {
        Schema::create('deliveries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('from_name', 100);
            $table->string('from_phone', 20);
            $table->string('from_email', 100);
            $table->text('from_address');

            $table->string('to_name', 100);
            $table->string('to_phone', 20);
            $table->string('to_email', 100);
            $table->text('to_address');
            $table->string('to_area', 100);
            $table->string('to_district', 100);
            $table->string('to_post_code', 5);

            $table->string('item_name', 150);
            $table->string('item_type', 150);
            $table->string('width', 150);
            $table->string('height', 150);
            $table->string('length', 150);
            $table->string('weight', 150);
            $table->text('instructions');
            $table->dateTime('pickup_time');

            $table->enum('status', ['processing','on_the_way', 'delivered'])->default('processing');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deliveries');
    }
}

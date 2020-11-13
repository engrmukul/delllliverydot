<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComplainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     * ONLY FOR FIREBASE CONFIGURATION
     */

    public function up()
    {
        Schema::create('complains', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('customer_id')->nullable()->references('id')->on('customers')->onDelete('cascade');
            $table->foreignId('restaurant_id')->nullable()->references('id')->on('restaurants')->onDelete('cascade');
            $table->foreignId('rider_id')->nullable()->references('id')->on('riders')->onDelete('cascade');
            $table->text('complain');
            $table->text('solution');
            $table->dateTime('complain_date');
            $table->enum('status', ['accepted','canceled','rejected','resolved'])->default('accepted');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('complains');
    }
}

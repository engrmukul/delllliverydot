<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoodVariantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('food_variants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('food_id')->references('id')->on('foods')->onDelete('cascade');
            $table->string('name', 255)->nullable(false);
            $table->double('price',8,2)->default(0.00);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('food_variants');
    }
}

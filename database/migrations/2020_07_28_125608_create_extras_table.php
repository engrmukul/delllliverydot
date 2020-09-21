<?php

use App\Traits\TableCommonColumn;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExtrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    use TableCommonColumn;

    public function up()
    {
        Schema::create('extras', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 150)->nullable(false);
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->double('price', 8,2)->default(0.00);
            $table->foreignId('food_id')->references('id')->on('foods')->onDelete('cascade');
            $table->foreignId('extra_group_id')->references('id')->on('extra_groups')->onDelete('cascade');
            $this->commonColumns($table);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('extras');
    }
}

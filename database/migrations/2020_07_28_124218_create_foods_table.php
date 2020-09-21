<?php

use App\Traits\TableCommonColumn;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    use TableCommonColumn;

    public function up()
    {
        Schema::create('foods', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 150)->nullable(false);
            $table->string('short_description', 200)->nullable();
            $table->string('image', 100)->nullable();
            $table->double('price',8,2)->default(0.00);
            $table->double('discount_price',8,2)->default(0.00);
            $table->text('description')->nullable();
            $table->text('ingredients')->nullable();
            $table->string('unit')->comment('Enter the unit of food (ex:L, ml, Kg, g)');
            $table->string('package_count',5)->comment('Number of item per package (ex: 6, 10)');
            $table->string('weight',5)->comment('Insert Weight of this food default unit is gramme (g)');
            $table->enum('featured', ['1','0'])->default('1');
            $table->enum('deliverable_food', ['1','0'])->default('1');
            $table->foreignId('restaurant_id')->references('id')->on('restaurants')->onDelete('cascade');
            $table->foreignId('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->text('options')->nullable()->comment('json data');
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
        Schema::dropIfExists('foods');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Traits\TableCommonColumn;

class CreateBusinessCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    use TableCommonColumn;
    public function up()
    {
        Schema::create('business_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',100);
            $table->string('tagline',200)->nullable();
            $table->string('image',200)->nullable();
            $table->float('discount',8,2)->default(0.00);
            $table->string('options')->nullable();
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
        Schema::dropIfExists('business_categories');
    }
}

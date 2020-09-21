<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShipperProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipper_profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('shipper_id')->references('id')->on('shippers')->onDelete('cascade');
            $table->string('nid_or_passport', 100);
            $table->string('image', 100);
            $table->date('dob');
            $table->date('spouse_dob')->nullable(false);
            $table->date('father_dob')->nullable(false);;
            $table->date('mother_dob')->nullable(false);;
            $table->date('anniversary')->nullable(false);;
            $table->date('first_child_dob')->nullable(false);;
            $table->date('second_child_dob')->nullable(false);;
            $table->text('address');
            $table->text('short_biography');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shipper_profiles');
    }
}

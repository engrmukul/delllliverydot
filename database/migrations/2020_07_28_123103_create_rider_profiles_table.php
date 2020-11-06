<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiderProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rider_profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('rider_id')->references('id')->on('riders')->onDelete('cascade');
            $table->string('nid_or_passport', 100)->nullable();
            $table->string('image', 100)->nullable();
            $table->date('dob')->nullable();
            $table->date('spouse_dob')->nullable();
            $table->date('father_dob')->nullable();
            $table->date('mother_dob')->nullable();
            $table->date('anniversary')->nullable();
            $table->date('first_child_dob')->nullable();
            $table->date('second_child_dob')->nullable();
            $table->text('address')->nullable();
            $table->text('short_biography')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rider_profiles');
    }
}

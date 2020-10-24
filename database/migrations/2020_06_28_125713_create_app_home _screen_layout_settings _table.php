<?php

use App\Traits\TableCommonColumn;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppHomeScreenLayoutSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    use TableCommonColumn;

    public function up()
    {
        Schema::create('app_home_screen_layout_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('row', ['trending','popular','discounted', 'favorite', 'trr', 'trf'])->default('trending')->comment('trr=top rating restaurant, trf=top rating food');
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
        Schema::dropIfExists('app_home_screen_layout_settings');
    }
}

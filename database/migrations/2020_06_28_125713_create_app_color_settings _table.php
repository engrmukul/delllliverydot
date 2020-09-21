<?php

use App\Traits\TableCommonColumn;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppColorSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    use TableCommonColumn;

    public function up()
    {
        Schema::create('app_color_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('page_button_color', 7)->default('#7F6E82');
            $table->string('map_button_color', 7)->default('#7F6E82');
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
        Schema::dropIfExists('app_color_settings');
    }
}

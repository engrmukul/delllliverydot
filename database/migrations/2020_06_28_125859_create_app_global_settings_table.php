<?php

use App\Traits\TableCommonColumn;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppGlobalSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    use TableCommonColumn;

    public function up()
    {
        Schema::create('app_global_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('app_name', 100);
            $table->string('google_maps_key', 200)->default('AIzaSyC3YYz8jqvHY3Yup1lzIdlU51FsjHKH5yE');
            $table->enum('default_unit_of_distance', ['kilometer','mile'])->default('kilometer');
            $table->enum('language', ['en','bn'])->default('en');
            $table->string('application_version')->default(1.1);
            $table->text('blocked_ips')->nullable()->comment('comma separate');
            $table->string('logo', 100);
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
        Schema::dropIfExists('app_global_settings');
    }
}

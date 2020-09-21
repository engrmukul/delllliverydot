<?php

use App\Traits\TableCommonColumn;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppSMSSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     * ONLY FOR FIREBASE CONFIGURATION
     */
    use TableCommonColumn;

    public function up()
    {
        Schema::create('app_sms_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('is_enable', ['1','0'])->default('1');
            $table->string('url', 200)->default('smtp.hostinger.com');
            $table->string('username', 50)->default('test@smartersvision.com');
            $table->string('password', 50)->default('123456789');
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
        Schema::dropIfExists('app_sms_settings');
    }
}

<?php

use App\Traits\TableCommonColumn;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppEmailSettingsTable extends Migration
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
        Schema::create('app_email_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('is_enable', ['1','0'])->default('1');
            $table->string('mail_host', 50)->default('smtp.hostinger.com');
            $table->string('mail_port', 5)->default(587);
            $table->enum('mail_encryption', ['TLS','SSL'])->default('TLS');
            $table->string('username', 50)->default('test@smartersvision.com');
            $table->string('password', 50)->default('123456789');
            $table->string('sender_email', 50)->default('test@smartersvision.com');
            $table->string('sender_name', 50)->default('delivery dot');
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
        Schema::dropIfExists('app_email_settings');
    }
}

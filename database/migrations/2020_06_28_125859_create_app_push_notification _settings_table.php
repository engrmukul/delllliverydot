<?php

use App\Traits\TableCommonColumn;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppPushNotificationSettingsTable extends Migration
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
        Schema::create('app_push_notification_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('is_enable', ['1','0'])->default('1');
            $table->string('firebase_cloud_messaging_key', 255)->default('AAAApe5CT7I:APA91bFAVF8gtVNbatfRMP8yBluzCaGmm1tmZtgAUhOW96QAYkXVQVxJRmU5KsDMPgyq163z_W3RQOD5ho1N25bykcGPtlBeacxccNZh8J6voZi3ls4NYlvCYhlxlPTo6AeOBkPA5Wnw');
            $table->string('api_key', 255)->default('AIzaSyB_UhyMxj8RU0eTQEhZnsCsiI6hQlNIPmg');
            $table->string('database_url', 100)->default('https://fooddeliver192.firebaseio.com');
            $table->string('storage_bucket', 100)->default('fooddeliver192.appspot.com');
            $table->string('application_id', 100)->default('1:712666927026:web:7b9bfbb66cf6a07b96deab');
            $table->string('auth_domain', 100)->default('fooddeliver192.firebaseapp.com');
            $table->string('project_id', 100)->default('fooddeliver192');
            $table->string('messaging_sender_id', 100)->default('712666927026');
            $table->string('measurement_id', 100)->default('0');
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
        Schema::dropIfExists('app_push_notification_settings');
    }
}

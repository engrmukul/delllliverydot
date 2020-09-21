<?php

use App\Traits\TableCommonColumn;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppPaymentSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    use TableCommonColumn;

    public function up()
    {
        Schema::create('app_payment_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('currency_id')->references('id')->on('app_currencies_settings')->onDelete('cascade');
            $table->float('default_tax', 4,2)->default(4.00);
            $table->float('default_vat', 4,2)->default(4.00);
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
        Schema::dropIfExists('app_payment_settings');
    }
}

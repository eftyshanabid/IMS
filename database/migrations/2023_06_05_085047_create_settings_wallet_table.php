<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsWalletTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings_wallet', function (Blueprint $table) {
            $table->id();
            $table->text('app_secret')->nullable();
            $table->text('app_api_key')->nullable();
            $table->text('app_version')->nullable();
            $table->text('callback_url')->nullable();
            $table->text('cancel_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings_wallet');
    }
}

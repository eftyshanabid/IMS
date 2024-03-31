<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTwoColumnInSettingsWebsite extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings_website', function (Blueprint $table) {
            $table->string('default_user_logo',128)->nullable()->after('logo');
            $table->string('default_user_cover',128)->nullable()->after('favicon');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('settings_website', function (Blueprint $table) {
            $table->dropColumn(['default_user_logo','default_user_cover']);
        });
    }
}

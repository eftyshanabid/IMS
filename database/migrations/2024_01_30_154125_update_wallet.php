<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings_wallet', function (Blueprint $table) {
            $table->dropColumn([
                'app_secret',
                'app_api_key',
                'app_version',
                'callback_url',
                'cancel_url',
            ]);

            $table->text('environment')->nullable()->after('id');
            $table->text('access_token')->nullable()->after('environment');
            $table->text('application_id')->nullable()->after('access_token');
            $table->text('location_id')->nullable()->after('application_id');
            $table->text('redirect_url')->nullable()->after('location_id');
            $table->text('merchant_support_email')->nullable()->after('redirect_url');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
        Schema::table('settings_wallet', function (Blueprint $table) {
            $table->dropColumn([
                'environment',
                'access_token',
                'application_id',
                'location_id',
                'redirect_url',
                'merchant_support_email',
            ]);

            $table->text('app_secret')->nullable()->after('id');
            $table->text('app_api_key')->nullable()->after('app_secret');
            $table->text('app_version')->nullable()->after('app_api_key');
            $table->text('callback_url')->nullable()->after('app_version');
            $table->text('cancel_url')->nullable()->after('callback_url');
        });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsMailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings_mail', function (Blueprint $table) {
            $table->id();
            $table->text('mail_mailer')->nullable();
            $table->text('mail_host')->nullable();
            $table->text('mail_port')->nullable();
            $table->text('mail_user_name')->nullable();
            $table->text('mail_user_password')->nullable();
            $table->text('mail_encryption')->nullable();
            $table->text('mail_from_address')->nullable();
            $table->text('mail_name')->nullable();
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
        Schema::dropIfExists('settings_mail');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsSocialMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings_social_media', function (Blueprint $table) {
            $table->id();
            $table->text('twitter')->nullable();
            $table->text('facebook')->nullable();
            $table->text('telegram')->nullable();
            $table->text('discord')->nullable();
            $table->text('youtube')->nullable();
            $table->text('vimeo')->nullable();
            $table->text('tiktok')->nullable();
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
        Schema::dropIfExists('settings_social_media');
    }
}

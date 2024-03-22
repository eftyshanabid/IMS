<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsWebsiteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings_website', function (Blueprint $table) {
            $table->id();
            $table->string('name',64)->nullable();
            $table->text('slogan')->nullable();
            $table->string('logo',128)->nullable();
            $table->string('favicon',128)->nullable();
            $table->string('fee_like_qty',128)->default(10);
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
        Schema::dropIfExists('settings_website');
    }
}

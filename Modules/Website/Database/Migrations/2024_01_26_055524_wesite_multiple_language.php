<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('settings_website', function (Blueprint $table) {
            $table->longText('name')->change();
            $table->longText('slogan')->change();
            $table->longText('official_address')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings_website', function (Blueprint $table) {
            $table->string('name')->change();
            $table->string('slogan')->change();
            $table->string('official_address')->change();
        });
    }
};

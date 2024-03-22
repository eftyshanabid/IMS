<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('settings_website', function (Blueprint $table) {
            $table->string('official_email', 128)->nullable()->after('favicon');
            $table->string('official_phone', 128)->nullable()->after('official_email');
            $table->string('official_address', 128)->nullable()->after('official_phone');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings_website', function (Blueprint $table) {
            $table->dropColumn(['official_email',
                'official_phone',
                'official_address']);
        });
    }
};

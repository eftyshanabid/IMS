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
            $table->longText('monthly_plan_features')->after('fee_like_qty')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings_website', function (Blueprint $table) {
            $table->dropColumn([
                'monthly_plan_features'
            ]);
        });
    }
};

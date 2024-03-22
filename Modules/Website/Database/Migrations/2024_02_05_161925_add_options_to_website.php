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
            $table->longText('business_structures')->after('service_agreements')->nullable();
            $table->longText('tax_filing_statuses')->after('business_structures')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings_website', function (Blueprint $table) {
            $table->dropColumn([
                'business_structures',
                'tax_filing_statuses',
            ]);
        });
    }
};

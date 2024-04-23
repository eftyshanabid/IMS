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
        Schema::create('grn_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('grn_id');
            $table->foreign('grn_id')->references('id')->on('grns');

            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products');

            $table->double('unit_price')->default(0);
            $table->double('qty')->default(0);
            $table->double('sub_total_price')->default(0);
            $table->double('discount')->default(0);
            $table->double('discount_amount')->default(0);
            $table->enum('vat_type', ['inclusive', 'exclusive'])->default('exclusive');
            $table->double('vat')->default(0);
            $table->double('vat_amount')->default(0);
            $table->double('total_price')->default(0);

            $table->enum('quality_ensure', ['pending', 'approved', 'return', 'replace'])->default('approved');
            $table->double('received_qty')->default(0);
            $table->date('expire_date')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grn_items');
    }
};

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
        Schema::create('stock_inventory', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('grn_item_id');
            $table->foreign('grn_item_id')->references('id')->on('grn_items');
            $table->unsignedBigInteger('warehouse_id');
            $table->foreign('warehouse_id')->references('id')->on('warehouses');

            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products');
            $table->double('qty')->default(0);
            $table->enum('status', ['fresh', 'expire'])->default('fresh')->nullable();
            $table->enum('type', ['in', 'out'])->default('in')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_inventory');
    }
};

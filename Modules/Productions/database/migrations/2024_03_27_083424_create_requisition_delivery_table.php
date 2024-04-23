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
        Schema::create('requisition_delivery', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('requisition_item_id');
            $table->foreign('requisition_item_id')->references('id')->on('requisition_items');

            $table->unsignedBigInteger('stock_inventory_id');
            $table->foreign('stock_inventory_id')->references('id')->on('stock_inventory');
            $table->double('issued_qty')->default(0);


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requisition_delivery');
    }
};

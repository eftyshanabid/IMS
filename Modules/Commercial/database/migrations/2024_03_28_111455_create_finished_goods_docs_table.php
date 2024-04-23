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
        Schema::create('finished_goods_docs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('finished_goods_delivery_id');
            $table->foreign('finished_goods_delivery_id')->references('id')->on('finished_goods_delivery');

            $table->double('discrepancies_charge')->default(0);
            $table->double('realized_value')->default(0);

            $table->text('fg_files')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('finished_goods_docs');
    }
};

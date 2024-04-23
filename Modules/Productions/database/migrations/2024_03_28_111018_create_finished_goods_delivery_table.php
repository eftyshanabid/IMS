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
        Schema::create('finished_goods_delivery', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('finished_good_id');
            $table->foreign('finished_good_id')->references('id')->on('finished_goods');
            $table->double('delivery_qty')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('finished_goods_delivery');
    }
};

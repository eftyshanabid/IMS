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
        Schema::create('proforma_invoices', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('supplier_id');
            $table->foreign('supplier_id')->references('id')->on('suppliers');

            $table->string('pi_no')->nullable();
            $table->date('pi_date')->nullable();
            $table->string('mrr_no')->nullable();
            $table->string('lc_no')->nullable();
            $table->string('lc_date')->nullable();
            $table->double('total_price')->default(0);
            $table->double('discount')->default(0);
            $table->double('vat')->default(0);
            $table->double('gross_price')->default(0);

            $table->enum('status', ['pending', 'approved', 'halt'])->default('pending')->nullable();
            $table->text('pi_file')->nullable();
            $table->text('instructions_file')->nullable();
            $table->text('remarks')->nullable();

            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');

            $table->softDeletes();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proforma_invoices');
    }
};

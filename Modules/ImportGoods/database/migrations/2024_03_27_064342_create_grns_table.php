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
        Schema::create('grns', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('proforma_invoice_id');
            $table->foreign('proforma_invoice_id')->references('id')->on('proforma_invoices');

            $table->string('reference_no');
            $table->string('invoice_no')->nullable();
            $table->string('invoice_file')->nullable();
            $table->date('received_date')->nullable();
            $table->text('note')->nullable();

            $table->double('total_price')->default(0);
            $table->double('discount')->default(0);
            $table->double('vat')->default(0);
            $table->double('gross_price')->default(0);
            $table->enum('status', ['full', 'partial'])->default('full')->nullable();

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
        Schema::dropIfExists('grns');
    }
};

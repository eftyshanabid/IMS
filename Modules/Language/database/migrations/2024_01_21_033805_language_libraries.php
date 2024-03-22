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
        Schema::create('language_libraries', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('language_id', false);
            $table->foreign('language_id')->references('id')->on('languages')->cascadeOnDelete()->cascadeOnUpdate();

            $table->text('slug');
            $table->text('translation');

            $table->unsignedBigInteger('created_by', false)->nullable();
            $table->unsignedBigInteger('updated_by', false)->nullable();
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
        Schema::dropIfExists('language_libraries');
    }
};

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
        Schema::create('pre_invoice_details', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();
            $table->foreignUuid('pre_invoice_id')->constrained();
            $table->foreignUuid('service_id')->constrained();
            $table->integer('quantity');
            $table->double('total_amount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pre_invoice_details');
    }
};

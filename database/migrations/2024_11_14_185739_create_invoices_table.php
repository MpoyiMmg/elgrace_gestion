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
        Schema::create('invoices', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();
            $table->string('reference')->unique()->nullable();
            $table->foreignUuid('pre_invoice_id')->constrained();
            $table->enum('status', ['unpaid', 'partialy_paid', 'paid'])->default('unpaid');
            $table->date('payment_date')->nullable();
            $table->date('completed_payment_date')->nullable();
            $table->double('paid_amount')->nullable();
            $table->double('remaining_amount')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};

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
        Schema::create('pre_invoices', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();
            $table->string('reference')->unique()->nullable();
            $table->foreignUuid('client_id')->constrained();
            $table->date('issue_date');
            $table->date('expiry_date')->nullable();
            $table->enum('status', ['draft', 'sent', 'accepted', 'rejected', 'pending', 'validated']);
            $table->date('validated_at')->nullable();
            $table->uuid('validated_by')->nullable()->constrained('users');
            $table->unsignedInteger('number')->nullable();
            $table->double('total_amount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pre_invoices');
    }
};

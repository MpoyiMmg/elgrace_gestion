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
        Schema::table('pre_invoices', function (Blueprint $table) {
            $table->double('total_ht')->nullable();
            $table->double('tva')->nullable();
            $table->double('total_ttc')->nullable();
            $table->integer('reduction_rate')->default(0);
            $table->double('reduction_ht')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pre_invoices', function (Blueprint $table) {
            //
        });
    }
};

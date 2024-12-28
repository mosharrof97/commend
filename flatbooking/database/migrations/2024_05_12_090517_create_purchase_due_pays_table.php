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
        Schema::create('purchase_due_pays', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->foreignId('purchase_id')
                    ->constrained('purchases')
                    ->onDelete('cascade');
            $table->bigInteger('invoice_no');
            $table->bigInteger('Return_invoice_no')->nullable();
            $table->decimal('due', 15, 2)->nullable();
            $table->decimal('pay',15,2)->nullable();

            $table->foreignId('created_by')
                    ->constrained('users')
                    ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_due_pays');
    }
};

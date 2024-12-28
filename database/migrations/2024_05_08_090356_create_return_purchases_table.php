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
        Schema::create('return_purchases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id');
            $table->foreignId('vendor_id');
            $table->string('memo_no');
            $table->foreignId('purchase_id');
            $table->bigInteger('invoice_no');
            $table->date('date');
            $table->string('name');
            $table->string('price');
            $table->string('quantity')->nullable();
            $table->string('unit')->nullable();
            $table->string('total_price');
            $table->decimal('total',15,2);
            $table->decimal('paid',15,2);
            $table->decimal('due',15,2);
            $table->bigInteger('status')->default(0);

            $table->foreignId('created_by')->nullable();
            $table->foreignId('updated_by')->nullable();
            $table->foreignId('deleted_by')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('return_purchases');
    }
};

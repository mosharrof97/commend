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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('voucher_no');
            $table->foreignId('project_id')->nullable();
            $table->string('cheque_number')->nullable();
            $table->unsignedBigInteger('income_expense_head_id')->nullable();
            $table->unsignedBigInteger('bank_cash_id')->nullable();
            $table->string('voucher_type');
            $table->date('voucher_date');
            $table->bigInteger('dr')->nullable();
            $table->bigInteger('cr')->nullable();
            $table->string('particulars')->nullable();

            $table->foreignId('created_by')->nullable();
            $table->foreignId('updated_by')->nullable();
            $table->foreignId('deleted_by')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};

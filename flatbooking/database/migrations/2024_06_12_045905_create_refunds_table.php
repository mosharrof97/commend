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
        Schema::create('refunds', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('flat_id');
            $table->unsignedBigInteger('flat_sale_id');
            $table->date('date');
            $table->string('refund_no')->nullable();
            $table->string('payment_type');
            $table->decimal('amount', 15, 2);
            $table->string('bank_name')->nullable();
            $table->string('branch')->nullable();
            $table->string('account_number',20)->nullable();
            $table->string('check_number',20)->nullable();
            $table->bigInteger('status')->default(0);
            $table->unsignedBigInteger('received_by');
            $table->timestamps();
            $table->softDeletes();


            // Adding foreign keys
            $table->foreign('flat_id')->references('id')->on('flats')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('flat_sale_id')->references('id')->on('flat_sale_infos')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('received_by')->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            // Adding indexes
            $table->index('flat_sale_id');
            $table->index('received_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('refunds');
    }
};

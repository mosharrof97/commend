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
        Schema::create('refund_balances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('flat_id');
            $table->decimal('balance');
            $table->timestamps();

            $table->foreign('flat_id')->references('id')->on('flats')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->index('flat_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('refund_balances');
    }
};

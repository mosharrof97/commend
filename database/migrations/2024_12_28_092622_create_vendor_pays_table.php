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
        Schema::create('vendor_pays', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendor_id')
                    ->constrained('vendors')
                    ->onDelete('cascade');
            $table->date('date');
            // $table->decimal('total_amount',15,2)->nullable();
            // $table->decimal('payable_amount',15,2)->nullable();
            $table->decimal('pay',15,2)->default(0.00);
            $table->decimal('due',15,2)->default(0.00);

            $table->foreignId('created_by')
                    ->constrained('users')
                    ->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendor_pays');
    }
};

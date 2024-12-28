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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->nullable();
            $table->date('date');
            $table->string('name')->nullable();
            $table->string('price');
            $table->string('quantity')->nullable();
            // $table->string('unit')->nullable();
            $table->string('total_price');
            $table->decimal('total',15,2);
            // $table->decimal('service_charge',15,2);
            // $table->decimal('shipping_charge',15,2);
            // $table->decimal('total_amount',15,2);
            // $table->decimal('discount',15,2);
            // $table->decimal('paid',15,2);
            // $table->decimal('due',15,2);

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
        Schema::dropIfExists('expenses');
    }
};

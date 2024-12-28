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
        Schema::create('client_addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->onDelete('cascade');
            $table->string('pre_address')->nullable();
            $table->string('pre_city')->nullable();
            $table->string('pre_district')->nullable();
            $table->integer('pre_zipCode')->nullable();

            $table->string('per_address')->nullable();
            $table->string('per_city')->nullable();
            $table->string('per_district')->nullable();
            $table->integer('per_zipCode')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_addresses');
    }
};

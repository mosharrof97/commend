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
        Schema::create('employee_addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id');
            $table->string('pre_address');
            $table->string('pre_city');
            $table->string('pre_district');
            $table->integer('pre_zipCode');

            $table->string('per_address');
            $table->string('per_city');
            $table->string('per_district');
            $table->integer('per_zipCode');
            $table->timestamps();

            $table->softDeletes();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_addresses');
    }
};

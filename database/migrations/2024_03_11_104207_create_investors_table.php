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
       Schema::create('investors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('father_name');
            $table->string('mother_name');
            $table->string('phone', 15)->unique();
            $table->string('nid', 20);
            $table->string('tin', 20);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('pre_address');
            $table->string('pre_city');
            $table->string('pre_district');
            $table->integer('pre_zipCode');

            $table->string('per_address');
            $table->string('per_city');
            $table->string('per_district');
            $table->integer('per_zipCode');

            $table->string('image');
            $table->foreignId('role_id');
            $table->enum('active_status',['active', 'inactive'])->default('inactive');
            $table->string('status')->default(0);

            $table->foreignId('created_by')->nullable();
            $table->foreignId('updated_by')->nullable();
            $table->foreignId('deleted_by')->nullable();

            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
       });

    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('investors');
    }
};

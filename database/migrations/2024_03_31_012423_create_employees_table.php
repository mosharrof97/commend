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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('gender');
            $table->string('father_name');
            $table->string('mother_name');
            $table->date('birth_date');
            $table->string('nationality');
            $table->string('phone',15)->unique();
            $table->string('nid',20)->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->date('join_date');
            $table->date('regain_date')->nullable();
            $table->string('password')->nullable();
            $table->string('image')->nullable();
            $table->foreignId('role_id')->nullable();
            $table->string('designation');
            $table->enum('active_status',['active', 'inactive'])->default('inactive');
            $table->string('status')->default(0);

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
        Schema::dropIfExists('employees');
    }
};

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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('nid',20)->unique();
            $table->string('phone',15)->unique();
            $table->foreignId('role_id');
            $table->enum('active_status',['active', 'inactive'])->default('inactive');
            $table->string('status')->default(0);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

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
        Schema::dropIfExists('admins');
    }
};

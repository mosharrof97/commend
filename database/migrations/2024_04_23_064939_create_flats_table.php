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
        Schema::create('flats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable();
            $table->foreignId('project_id')->constrained()->onDelete('cascade');
            $table->foreignId('client_id')->nullable();
            $table->string('name');
            $table->string('floor');
            $table->integer('flat_area')->nullable();
            $table->decimal('price',15,2);
            $table->integer('room')->nullable();
            $table->integer('dining_space')->nullable();
            $table->integer('bath_room')->nullable();
            $table->string('parking')->nullable();
            $table->string('outdoor')->nullable();
            $table->string('images')->nullable();
            $table->text('description')->nullable();
            $table->integer('active_status')->default(0);
            $table->integer('sale_status')->default(0);
            $table->integer('status')->default(0);

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
        Schema::dropIfExists('flats');
    }
};

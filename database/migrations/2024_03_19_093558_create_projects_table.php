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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('projectName')->nullable();
            $table->decimal('budget',15,2)->nullable();
            $table->integer('land_area')->nullable();
            $table->string('front_road',100)->nullable();
            $table->string('property_type')->nullable();
            $table->string('floor')->nullable();
            $table->string('comm_space_size')->nullable();
            $table->string('num_of_basement')->nullable();
            $table->integer('flat')->nullable();
            $table->string('duration',50)->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->foreignId('district_id')->nullable();
            $table->integer('zipCode')->nullable();
            $table->string('image')->nullable();
            $table->integer('status')->default(0);
            $table->integer('active_status')->default(0);

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
        Schema::dropIfExists('projects');
    }
};

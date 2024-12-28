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
        Schema::create('flat_sale_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('flat_id');
            $table->decimal('price',15,2);
            $table->bigInteger('status')->default(0);
            $table->unsignedBigInteger('sold_by');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Adding foreign keys
            $table->foreign('flat_id')->references('id')->on('flats')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('sold_by')->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            // Adding indexes
            $table->index('flat_id');
            $table->index('sold_by');
            $table->index('created_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flat_sale_infos');
    }
};

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
        Schema::create('vehicle_varients', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('vehicle_make_id'); 
            $table->unsignedBigInteger('vehicle_model_id'); 
            $table->string('name')->unique();
            $table->timestamps();

            $table->foreign('vehicle_make_id')->references('id')->on('vehicle_makes')->onDelete('cascade');
            $table->foreign('vehicle_model_id')->references('id')->on('vehicle_models')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_varients');
    }
};

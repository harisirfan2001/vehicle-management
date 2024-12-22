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
        Schema::create('fuels', function (Blueprint $table) {
            $table->id();

           
            $table->unsignedBigInteger('vehicle_no');
            $table->unsignedBigInteger('driver_name');
            $table->integer('meter_reading_on_refilling');
            $table->string('fuel_type');
            $table->string('current_fuel_status');
            $table->time('time');
            $table->date('date');
            $table->float('fuel_cost');
            $table->float('total_fuel_qty');
            $table->float('total_price');
            $table->string('refilling_station');
            $table->text('remarks')->nullable();
            $table->string('payment_mode');
            $table->string('file')->nullable();
            $table->timestamps();

            $table->foreign('vehicle_no')->references('id')->on('vehicles')->onDelete('cascade');
            $table->foreign('driver_name')->references('id')->on('drivers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fuels');
    }
};

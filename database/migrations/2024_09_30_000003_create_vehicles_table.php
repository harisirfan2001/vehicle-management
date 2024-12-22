<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('make_id'); 
            $table->unsignedBigInteger('model_id'); 
            $table->unsignedBigInteger('varient_id'); 
            $table->unsignedBigInteger('vehicle_type'); 
            $table->integer('model_year');
            $table->string('color');
            $table->string('licence_plate');// using it as primary key in gatepass form as a foreign key 
            $table->string('registration_city');
            $table->string('province');          
            $table->integer('initial_mileage');
            $table->string('image');
            $table->timestamps();
            // $table->integer('horse_power')->nullable();
            // $table->integer('year')->nullable();
            // $table->float('average_km_per_gallon')->nullable();
            // $table->date('license_expiry_date')->nullable();
            // $table->string('vehicle_group')->nullable();
            // $table->date('registration_expiry_date')->nullable();
            // $table->string('user_defined_field')->nullable();

            // Foreign key constraints
            $table->foreign('make_id')->references('id')->on('vehicle_makes')->onDelete('cascade');
            $table->foreign('model_id')->references('id')->on('vehicle_models')->onDelete('cascade');
            $table->foreign('varient_id')->references('id')->on('vehicle_varients')->onDelete('cascade');
            $table->foreign('vehicle_type')->references('id')->on('vehicle_types')->onDelete('cascade');

        });
    }

    public function down()
    {
        Schema::dropIfExists('vehicles');
    }
}

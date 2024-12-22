<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGatePassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gate_passes', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('gate_pass_number');
            $table->string('vehicle_no');
            $table->string('driver_name');
            $table->integer('meter_out');
            $table->integer('meter_in')->nullable();
            $table->string('covered_km')->nullable();
            $table->time('time_out');
            $table->time('time_in')->nullable();
            $table->string('total_time')->nullable();
            $table->string('user_officer');
            $table->string('area_name');
            $table->string('reason_to_travel');
            $table->string('pass_receiver');
            $table->string('pass_receiver_id');
            $table->string('pass_receiver_checkin')->nullable();
            $table->string('pass_receiver_checkin_id')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->boolean('is_visible')->default(true);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->timestamps();
           
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gate_passes');
    }
}

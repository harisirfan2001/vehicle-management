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
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->string('employee_number');
            $table->string('full_name');
            $table->string('father_name');
            $table->date('date_of_birth');
            $table->string('cnic_number');
            $table->string('permanent_address');
            $table->string('temporary_address');
            $table->text('contact_number');
            $table->string('blood_group');
            $table->string('disability')->default('None');
            $table->string('emergency_contact');
            $table->string('marital_status');
            $table->string('health_certificate');
            $table->string('driver_photo');
            $table->text('license_images');
            $table->text('cnic_images');
            $table->text('reference_name');
            $table->text('relationship');
            $table->text('reference_contact');
            $table->text('reference_cnic');
            $table->text('reference_address');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drivers');
    }
};

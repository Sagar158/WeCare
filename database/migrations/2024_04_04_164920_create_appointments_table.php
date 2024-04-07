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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->integer('patient_id');
            $table->integer('appointment_number');
            $table->string('appointment_date');
            $table->string('appointment_time');
            $table->enum('type',['recording','visit'])->default('visit');
            $table->integer('healthcare_id');
            $table->integer('specialization_id');
            $table->integer('doctor_id'); //This will be doctor id
            $table->longText('reason');
            $table->enum('status',['pending','confirmed','cancelled','completed'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};

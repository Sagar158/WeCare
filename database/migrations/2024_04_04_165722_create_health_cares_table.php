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
        Schema::create('health_cares', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('institute_address');
            $table->string('contact_number');
            $table->string('opening_hours');
            $table->string('closing_hours');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('health_cares');
    }
};

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
        Schema::table('health_cares', function (Blueprint $table) {
            $table->longText('history')->nullable();
            $table->longText('map_link')->nullable();
            $table->enum('from_day',['monday','tuesday','wednesday','thursday','friday','saturday','sunday'])->default('monday');
            $table->enum('to_day',['monday','tuesday','wednesday','thursday','friday','saturday','sunday'])->default('friday');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('health_cares', function (Blueprint $table) {
            $table->dropColumn('history');
            $table->dropColumn('map_link');
            $table->dropColumn('from_day');
            $table->dropColumn('to_day');
        });
    }
};

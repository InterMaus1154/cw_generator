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
            $table->increments('appt_id');
            $table->unsignedInteger('vehicle_id');
            $table->foreign('vehicle_id')->references('vehicle_id')->on('vehicles');
            $table->date('appt_date');
            $table->time('appt_time');
            $table->text('appt_remarks')->nullable();
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

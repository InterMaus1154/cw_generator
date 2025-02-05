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
        Schema::create('appointment_services', function (Blueprint $table) {
            $table->unsignedInteger('service_id');
            $table->unsignedInteger('appt_id');

            $table->primary(['service_id', 'appt_id']);
            $table->foreign('service_id')->references('service_id')->on('services');
            $table->foreign('appt_id')->references('appt_id')->on('appointments');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointment_services');
    }
};

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
        Schema::create('booking_services', function (Blueprint $table) {
            $table->id('booking_service_id');
            $table->unsignedBigInteger('booking_id');
            $table->unsignedBigInteger('service_id');

            $table->foreign('booking_id')->references('booking_id')->on('bookings')->restrictOnDelete();
            $table->foreign('service_id')->references('service_id')->on('services')->restrictOnDelete();

            $table->unique(['booking_id', 'service_id'], 'uq_booking_service_booking_service');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_services');
    }
};

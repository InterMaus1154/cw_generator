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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id('booking_id');
            $table->unsignedBigInteger('vec_id');
            $table->unsignedBigInteger('branch_id');
            $table->date('booking_date');
            $table->time('booking_time');
            $table->text('booking_comments')->nullable();

            $table->foreign('vec_id')->references('vec_id')->on('vehicles')->restrictOnDelete();
            $table->foreign('branch_id')->references('branch_id')->on('branches')->restrictOnDelete();

            $table->index('vec_id', 'idx_booking_vehicle');
            $table->index('booking_date', 'idx_booking_date');
            $table->index(['branch_id', 'booking_date'], 'idx_booking_branch_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};

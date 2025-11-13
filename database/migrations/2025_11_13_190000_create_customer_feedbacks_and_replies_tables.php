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
        Schema::create('customer_feedbacks', function (Blueprint $table) {
            $table->id('cust_fb_id');
            $table->unsignedBigInteger('cust_id');
            $table->unsignedBigInteger('booking_id');
            $table->text('cust_fb_content');

            $table->foreign('cust_id')->references('cust_id')->on('customers')->restrictOnDelete();
            $table->foreign('booking_id')->references('booking_id')->on('bookings')->restrictOnDelete();
        });

        Schema::create('feedback_replies', function (Blueprint $table) {
            $table->id('reply_id');
            $table->unsignedBigInteger('cust_fb_id');
            $table->unsignedBigInteger('staff_id')->nullable();
            $table->unsignedBigInteger('cust_id')->nullable();
            $table->unsignedBigInteger('reply_to')->nullable();
            $table->text('reply_content');

            $table->foreign('cust_fb_id')->references('cust_fb_id')->on('customer_feedbacks')->cascadeOnDelete();
            $table->foreign('staff_id')->references('staff_id')->on('staff')->restrictOnDelete();
            $table->foreign('cust_id')->references('cust_id')->on('customers')->restrictOnDelete();
            $table->foreign('reply_to')->references('reply_id')->on('feedback_replies')->restrictOnDelete();
        });

        Schema::table('customer_feedbacks', function (Blueprint $table) {
            $table->index('booking_id', 'idx_customer_feedback_booking');
        });

        Schema::table('feedback_replies', function (Blueprint $table) {
            $table->index('cust_fb_id', 'idx_feedback_replies_feedback');
            $table->index('reply_to', 'idx_feedback_replies_parent');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedback_replies');
        Schema::dropIfExists('customer_feedbacks');
    }
};

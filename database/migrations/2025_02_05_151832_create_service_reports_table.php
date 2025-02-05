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
        Schema::create('service_reports', function (Blueprint $table) {
            $table->increments('service_report_id');
            $table->unsignedInteger('appt_id');
            $table->unsignedInteger('emp_id');
            $table->unsignedInteger('cust_fb_id')->nullable();
            $table->text('service_report_remarks')->nullable();
            $table->foreign('appt_id')->references('appt_id')->on('appointments');
            $table->foreign('emp_id')->references('emp_id')->on('employees');
            $table->foreign('cust_fb_id')->references('cust_fb_id')->on('customer_feedback');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_reports');
    }
};

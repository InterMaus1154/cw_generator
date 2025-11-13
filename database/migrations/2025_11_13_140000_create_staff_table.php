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
        Schema::create('staff', function (Blueprint $table) {
            $table->id('staff_id');
            $table->unsignedBigInteger('branch_id');
            $table->char('staff_code', 11)->unique();
            $table->string('staff_fname', 50);
            $table->string('staff_lname', 50);
            $table->string('staff_email', 200)->unique();
            $table->string('staff_work_email', 200)->unique();
            $table->char('staff_mobile', 15)->unique();
            $table->char('staff_work_phone', 15)->nullable();
            $table->string('staff_address_first', 100);
            $table->string('staff_address_second', 100)->nullable();
            $table->unsignedBigInteger('staff_city');
            $table->char('staff_postcode', 8);
            $table->date('hired_at');

            $table->foreign('branch_id')->references('branch_id')->on('branches')->restrictOnDelete();
            $table->foreign('staff_city')->references('city_id')->on('cities')->restrictOnDelete();

            $table->index(['branch_id'], 'idx_staff_branch');
            $table->index(['staff_code'], 'idx_staff_code');
            $table->index(['staff_fname', 'staff_lname'], 'idx_staff_name');
            $table->index(['staff_city', 'staff_postcode'], 'idx_staff_location');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff');
    }
};

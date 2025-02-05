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
        Schema::create('employee_roles', function (Blueprint $table) {
            $table->unsignedInteger('emp_id');
            $table->unsignedInteger('role_id');
            $table->unsignedInteger('dept_id');

            $table->primary(['emp_id', 'role_id', 'dept_id']);

            $table->foreign('emp_id')->references('emp_id')->on('employees');
            $table->foreign('role_id')->references('role_id')->on('roles');
            $table->foreign('dept_id')->references('dept_id')->on('departments');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_roles');
    }
};

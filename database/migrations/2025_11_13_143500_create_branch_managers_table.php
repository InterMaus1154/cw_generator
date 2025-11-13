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
        Schema::create('branch_managers', function (Blueprint $table) {
            $table->id('branch_man_id');
            $table->unsignedBigInteger('branch_id');
            $table->unsignedBigInteger('staff_id');
            $table->date('assigned_at');
            $table->boolean('is_active')->default(true);

            $table->foreign('branch_id')->references('branch_id')->on('branches')->restrictOnDelete();
            $table->foreign('staff_id')->references('staff_id')->on('staff')->restrictOnDelete();
        });

        Schema::table('branch_managers', function (Blueprint $table) {
            $table->index(['branch_id', 'is_active'], 'idx_branch_manager_branch_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branch_managers');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('part_usage', function (Blueprint $table) {
            $table->unsignedBigInteger('job_id');
            $table->unsignedBigInteger('part_id');
            $table->smallInteger('quantity')->unsigned();

            $table->primary(['job_id', 'part_id']);

            $table->foreign('job_id')->references('job_id')->on('jobs')->restrictOnDelete();
            $table->foreign('part_id')->references('part_id')->on('parts')->restrictOnDelete();
        });

        DB::statement('ALTER TABLE part_usage ADD CONSTRAINT chk_part_usage_quantity_positive CHECK (quantity > 0)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('part_usage');
    }
};

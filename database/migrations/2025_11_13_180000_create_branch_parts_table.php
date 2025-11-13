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
        Schema::create('branch_parts', function (Blueprint $table) {
            $table->unsignedBigInteger('branch_id');
            $table->unsignedBigInteger('part_id');
            $table->smallInteger('quantity')->unsigned();

            $table->primary(['branch_id', 'part_id']);

            $table->foreign('branch_id')->references('branch_id')->on('branches')->restrictOnDelete();
            $table->foreign('part_id')->references('part_id')->on('parts')->restrictOnDelete();
        });

        DB::statement('ALTER TABLE branch_parts ADD CONSTRAINT chk_branch_parts_quantity_nonneg CHECK (quantity >= 0)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branch_parts');
    }
};

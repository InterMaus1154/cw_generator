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
        Schema::create('part_suppliers', function (Blueprint $table) {
            $table->integer('sup_id');
            $table->integer('part_id');
            $table->decimal('unit_cost', 10, 2);
            $table->smallInteger('min_order_quantity')->nullable();

            // Primary key (composite)
            $table->primary(['part_id', 'sup_id']);

            // Foreign keys
            $table->foreign('sup_id')
                ->references('sup_id')
                ->on('suppliers')
                ->onDelete('cascade');

            $table->foreign('part_id')
                ->references('part_id')
                ->on('parts')
                ->onDelete('cascade');

            // Indexes
            $table->index(['part_id', 'unit_cost'], 'idx_part_unit_cost_supplier');
            $table->index('sup_id', 'idx_parts_supplied_by_supplier');
        });

        // Add check constraint for min_order_quantity > 0
        DB::statement('ALTER TABLE part_suppliers ADD CONSTRAINT check_min_order_quantity CHECK (min_order_quantity >= 0)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('part_suppliers');
    }
};

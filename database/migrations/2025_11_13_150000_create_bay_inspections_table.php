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
        // Create Postgres ENUM type for bay inspection status if not exists
        DB::statement("DO $$
        BEGIN
            IF NOT EXISTS (SELECT 1 FROM pg_type WHERE typname = 'bay_inspection_status') THEN
                CREATE TYPE bay_inspection_status AS ENUM ('PENDING','IN_PROGRESS','PASSED','FAILED','REINSPECTION_DUE','CANCELLED');
            END IF;
        END$$;");

        Schema::create('bay_inspections', function (Blueprint $table) {
            $table->id('inspection_id');
            $table->unsignedBigInteger('bay_id');
            $table->unsignedBigInteger('inspected_by');
            $table->date('inspection_date');
            // inspection_status column will be added using the Postgres enum type below via raw SQL
            $table->date('inspection_next_due_date');
            $table->text('inspection_remarks');

            $table->foreign('bay_id')->references('bay_id')->on('bays')->restrictOnDelete();
            $table->foreign('inspected_by')->references('staff_id')->on('staff')->restrictOnDelete();
        });

        // Add the enum column as Postgres enum
        DB::statement('ALTER TABLE bay_inspections ADD COLUMN inspection_status bay_inspection_status NOT NULL');

        // Indexes
        Schema::table('bay_inspections', function (Blueprint $table) {
            $table->index(['bay_id', 'inspection_status'], 'idx_bay_inspection_bay_status');
            $table->index(['bay_id', 'inspection_next_due_date'], 'idx_bay_inspection_bay_next_inspection');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bay_inspections');
        DB::statement('DROP TYPE IF EXISTS bay_inspection_status');
    }
};

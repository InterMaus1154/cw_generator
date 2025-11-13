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
        DB::statement("DO $$
        BEGIN
            IF NOT EXISTS (SELECT 1 FROM pg_type WHERE typname = 'job_status') THEN
                CREATE TYPE job_status AS ENUM ('SCHEDULED', 'IN_PROGRESS', 'ON_HOLD', 'COMPLETED', 'CANCELLED', 'FAILED');
            END IF;
        END$$;");

        Schema::create('jobs', function (Blueprint $table) {
            $table->id('job_id');
            $table->unsignedBigInteger('staff_id');
            $table->unsignedBigInteger('booking_service_id');
            $table->unsignedBigInteger('bay_id');
            $table->date('job_assigned_at');
            $table->date('job_due_at');
            $table->timestamp('job_start')->nullable();
            $table->timestamp('job_end')->nullable();
            $table->text('job_notes')->nullable();

            $table->foreign('staff_id')->references('staff_id')->on('staff')->restrictOnDelete();
            $table->foreign('booking_service_id')->references('booking_service_id')->on('booking_services')->restrictOnDelete();
            $table->foreign('bay_id')->references('bay_id')->on('bays')->restrictOnDelete();
        });

        DB::statement("ALTER TABLE jobs ADD COLUMN job_status job_status NOT NULL DEFAULT 'SCHEDULED'");
        DB::statement("CREATE INDEX IF NOT EXISTS idx_job_staff_due ON jobs (staff_id, job_due_at)");
        DB::statement("CREATE INDEX IF NOT EXISTS idx_job_staff_status_due ON jobs (staff_id, job_status, job_due_at)");

        DB::statement("ALTER TABLE jobs ADD CONSTRAINT chk_job_start_end CHECK (job_start IS NULL OR job_end IS NULL OR job_start < job_end)");
        DB::statement("ALTER TABLE jobs ADD CONSTRAINT chk_job_assigned_due CHECK (job_assigned_at <= job_due_at)");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
        DB::statement('DROP TYPE IF EXISTS job_status');
    }
};

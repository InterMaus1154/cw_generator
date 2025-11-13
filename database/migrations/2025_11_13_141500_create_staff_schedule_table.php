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
        // Create Postgres ENUM type for schedule day (if using Postgres) - only create if not exists
        DB::statement("DO $$
        BEGIN
            IF NOT EXISTS (SELECT 1 FROM pg_type WHERE typname = 'staff_schedule_day') THEN
                CREATE TYPE staff_schedule_day AS ENUM ('MONDAY','TUESDAY','WEDNESDAY','THURSDAY','FRIDAY','SATURDAY','SUNDAY');
            END IF;
        END$$;");

        Schema::create('staff_schedule', function (Blueprint $table) {
            $table->id('schedule_id');
            $table->unsignedBigInteger('staff_id');
            // schedule_day will be added as a Postgres enum column via raw SQL below to match existing project pattern
            $table->time('schedule_start_time');
            $table->time('schedule_end_time');

            $table->foreign('staff_id')->references('staff_id')->on('staff')->restrictOnDelete();
        });

        // Add the ENUM column using raw SQL so it uses the Postgres enum type
        DB::statement('ALTER TABLE staff_schedule ADD COLUMN schedule_day staff_schedule_day NOT NULL');

        // Add check constraint for schedule times (Laravel schema doesn't support check() in this repo)
        DB::statement('ALTER TABLE staff_schedule ADD CONSTRAINT chk_schedule_times CHECK (schedule_start_time < schedule_end_time)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff_schedule');
        // Drop the ENUM type
        DB::statement('DROP TYPE IF EXISTS staff_schedule_day');
    }
};

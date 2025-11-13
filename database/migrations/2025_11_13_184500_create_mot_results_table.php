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
            IF NOT EXISTS (SELECT 1 FROM pg_type WHERE typname = 'mot_result_status') THEN
                CREATE TYPE mot_result_status AS ENUM ('PASS', 'FAIL', 'PASS_WITH_DEFECTS', 'FAIL_DANGEROUS');
            END IF;
        END$$;");

        Schema::create('mot_results', function (Blueprint $table) {
            $table->id('mot_res_id');
            $table->unsignedBigInteger('booking_id');
            $table->unsignedBigInteger('vec_id');
            $table->unsignedBigInteger('staff_id');
            $table->date('test_date');
            $table->date('expiry_date');
            $table->integer('mileage_reading');
            $table->text('comments');

            $table->foreign('booking_id')->references('booking_id')->on('bookings')->restrictOnDelete();
            $table->foreign('vec_id')->references('vec_id')->on('vehicles')->restrictOnDelete();
            $table->foreign('staff_id')->references('staff_id')->on('staff')->restrictOnDelete();
        });

        DB::statement("ALTER TABLE mot_results ADD COLUMN result mot_result_status NOT NULL");
        DB::statement("ALTER TABLE mot_results ADD CONSTRAINT chk_mot_mileage_positive CHECK (mileage_reading > 0)");
        DB::statement("ALTER TABLE mot_results ADD CONSTRAINT chk_mot_dates CHECK (test_date < expiry_date)");

        DB::statement('CREATE INDEX IF NOT EXISTS idx_mot_result_vehicle_expiry_date ON mot_results (vec_id, expiry_date DESC)');
        DB::statement('CREATE INDEX IF NOT EXISTS idx_mot_result_test_date ON mot_results (test_date)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mot_results');
        DB::statement('DROP TYPE IF EXISTS mot_result_status');
    }
};

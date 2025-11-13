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
        // Create Postgres ENUM type for certification level if not exists
        DB::statement("DO $$
        BEGIN
            IF NOT EXISTS (SELECT 1 FROM pg_type WHERE typname = 'staff_certification_level') THEN
                CREATE TYPE staff_certification_level AS ENUM ('TRAINEE', 'LEVEL_1', 'LEVEL_2', 'LEVEL_3', 'MASTER_TECHNICIAN');
            END IF;
        END$$;");

        Schema::create('staff_certifications', function (Blueprint $table) {
            $table->id('staff_cert_id');
            $table->unsignedBigInteger('staff_id');
            $table->string('cert_name', 100);

            $table->foreign('staff_id')->references('staff_id')->on('staff')->restrictOnDelete();

            $table->index('staff_id', 'idx_staff_cert_staff');
        });

        // Add the enum column using raw SQL so it uses the Postgres enum type
        DB::statement("ALTER TABLE staff_certifications ADD COLUMN cert_level staff_certification_level NOT NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff_certifications');
        DB::statement('DROP TYPE IF EXISTS staff_certification_level');
    }
};

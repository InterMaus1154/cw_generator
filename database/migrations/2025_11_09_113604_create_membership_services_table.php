<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */

    public function up(): void
    {
        // Create ENUM type for PostgreSQL

        DB::statement("
        DO $$
        BEGIN
            IF NOT EXISTS (SELECT 1 FROM pg_type WHERE typname = 'membership_discount_type') THEN
                CREATE TYPE membership_discount_type AS ENUM ('FIXED', 'PERCENT');
            END IF;
        END$$;
    ");

        Schema::create('membership_services', function (Blueprint $table) {
            $table->integer('mship_id');
            $table->integer('service_id');
            $table->decimal('discount_value', 6, 2);

            // Primary key (composite)
            $table->primary(['mship_id', 'service_id']);

            // Foreign keys
            $table->foreign('mship_id')
                ->references('mship_id')
                ->on('memberships')
                ->onDelete('cascade');

            $table->foreign('service_id')
                ->references('service_id')
                ->on('services')
                ->onDelete('cascade');
        });

        // Add the ENUM column using raw SQL
        DB::statement('ALTER TABLE membership_services ADD COLUMN discount_type membership_discount_type NOT NULL');
    }

    public function down(): void
    {
        Schema::dropIfExists('membership_services');
        DB::statement('DROP TYPE IF EXISTS membership_discount_type');
    }
};

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
            IF NOT EXISTS (SELECT 1 FROM pg_type WHERE typname = 'membership_pay_period') THEN
                CREATE TYPE membership_pay_period AS ENUM ('YEARLY', 'MONTHLY', 'WEEKLY');
            END IF;
        END$$;
    ");

        Schema::create('memberships', function (Blueprint $table) {
            $table->id('mship_id');
            $table->string('mship_name', 30);
            $table->text('mship_description');
            $table->decimal('mship_price', 8, 2);
            $table->smallInteger('mship_duration_days');

            // For PostgreSQL ENUM type, we need to use raw SQL in the column definition
            // This will be added after the table creation

            // Index
            $table->index(['mship_price', 'mship_duration_days'], 'idx_customer_membership_duration');
        });

        // Add the ENUM column using raw SQL
        DB::statement('ALTER TABLE memberships ADD COLUMN mship_pay_period membership_pay_period NOT NULL');
    }

    public function down(): void
    {

        Schema::dropIfExists('memberships');
        DB::statement('DROP TYPE IF EXISTS membership_pay_period');
    }

};

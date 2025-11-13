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
        // Create ENUM type for PostgreSQL
        DB::statement("
        DO $$
        BEGIN
            IF NOT EXISTS (SELECT 1 FROM pg_type WHERE typname = 'emergency_contact_type') THEN
                CREATE TYPE emergency_contact_type AS ENUM ('LANDLINE', 'MOBILE', 'EMAIL');
            END IF;
        END$$;
    ");

        Schema::create('customer_emergency_contacts', function (Blueprint $table) {
            $table->id('emg_id');
            $table->integer('cust_id');
            $table->string('emg_contact', 200);

            // Foreign key
            $table->foreign('cust_id')
                ->references('cust_id')
                ->on('customers')
                ->onDelete('cascade');

            // Index
            $table->index('cust_id', 'idx_emergency_contact_customer_id');
        });

        // Add the ENUM column using raw SQL
        DB::statement('ALTER TABLE customer_emergency_contacts ADD COLUMN emg_type emergency_contact_type NOT NULL');
    }

    public function down(): void
    {
        Schema::dropIfExists('customer_emergency_contacts');
        DB::statement('DROP TYPE IF EXISTS emergency_contact_type');
    }
};

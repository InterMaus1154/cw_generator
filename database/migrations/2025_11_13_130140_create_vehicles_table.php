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
            IF NOT EXISTS (SELECT 1 FROM pg_type WHERE typname = 'vehicle_fuel_types') THEN
                CREATE TYPE vehicle_fuel_types AS ENUM ('PETROL', 'DIESEL', 'HYBRID', 'ELECTRIC');
            END IF;
        END$$;
    ");

        Schema::create('vehicles', function (Blueprint $table) {
            $table->id('vec_id');
            $table->integer('vec_brand_id');
            $table->integer('cust_id');
            $table->string('vec_model', 50);
            $table->char('vec_reg', 7)->unique();
            $table->smallInteger('vec_year');
            $table->string('vec_colour', 10)->nullable();
            $table->char('vec_vin', 17)->unique();

            // Foreign keys
            $table->foreign('vec_brand_id')
                ->references('vec_brand_id')
                ->on('vehicle_brands')
                ->onDelete('restrict');

            $table->foreign('cust_id')
                ->references('cust_id')
                ->on('customers')
                ->onDelete('cascade');

            // Indexes
            $table->index('cust_id', 'idx_vehicle_customer');
            $table->index('vec_reg', 'idx_vehicle_registration_number');
            $table->index('vec_vin', 'idx_vehicle_vin');
        });

        // Add the ENUM column using raw SQL
        DB::statement('ALTER TABLE vehicles ADD COLUMN vec_fuel_type vehicle_fuel_types NOT NULL');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};

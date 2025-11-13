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
        DB::statement("
        DO $$
        BEGIN
            IF NOT EXISTS (SELECT 1 FROM pg_type WHERE typname = 'bay_status') THEN
                CREATE TYPE bay_status AS ENUM ('AVAILABLE', 'OCCUPIED', 'UNDER_MAINTENANCE', 'RESERVED', 'INACTIVE');
            END IF;
        END$$;
    ");


        Schema::create('bays', function (Blueprint $table) {
            $table->id('bay_id');
            $table->foreignId('branch_id')->references('branch_id')->on('branches')->cascadeOnDelete();
            $table->string('bay_name', 50);
            $table->smallInteger('bay_capacity');
        });

        DB::statement('ALTER TABLE bays ADD COLUMN bay_status bay_status NOT NULL');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bays');
    }
};

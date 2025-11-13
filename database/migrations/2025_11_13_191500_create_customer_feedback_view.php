<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Create a read-only view to maintain compatibility with code/queries
        // that still reference the singular table name `customer_feedback`.
        DB::statement('CREATE OR REPLACE VIEW customer_feedback AS SELECT * FROM customer_feedbacks');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS customer_feedback');
    }
};

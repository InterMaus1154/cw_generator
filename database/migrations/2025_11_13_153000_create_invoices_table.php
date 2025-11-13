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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id('inv_id');
            $table->unsignedBigInteger('booking_id');
            $table->char('inv_number', 16)->unique();
            $table->date('inv_issue_date');
            $table->date('inv_due_date');
            $table->decimal('inv_total', 10, 2)->nullable();
            $table->decimal('inv_discount', 10, 2)->nullable();
            $table->decimal('inv_final', 10, 2)->nullable();

            $table->foreign('booking_id')->references('booking_id')->on('bookings')->restrictOnDelete();

            $table->index('booking_id', 'idx_invoice_booking');
            $table->index('inv_issue_date', 'idx_invoice_issue_date');
        });

        // Create Postgres ENUM type for payment_status if not exists
        DB::statement("DO $$
        BEGIN
            IF NOT EXISTS (SELECT 1 FROM pg_type WHERE typname = 'payment_status') THEN
                CREATE TYPE payment_status AS ENUM ('PAID','OVERDUE','PENDING');
            END IF;
        END$$;");

        // Add enum column using the Postgres type
        DB::statement("ALTER TABLE invoices ADD COLUMN IF NOT EXISTS inv_status payment_status NOT NULL DEFAULT 'PENDING'");

        // Add CHECK constraints via raw SQL
        DB::statement("ALTER TABLE invoices ADD CONSTRAINT chk_inv_dates CHECK (inv_issue_date <= inv_due_date)");
        DB::statement("ALTER TABLE invoices ADD CONSTRAINT chk_inv_total_positive CHECK (inv_total > 0)");
        DB::statement("ALTER TABLE invoices ADD CONSTRAINT chk_inv_final_positive CHECK (inv_final > 0)");
        DB::statement("ALTER TABLE invoices ADD CONSTRAINT chk_inv_discount_nonneg CHECK (inv_discount >= 0)");
        DB::statement("ALTER TABLE invoices ADD CONSTRAINT chk_inv_final_vs_total CHECK (inv_final <= (inv_total - inv_discount))");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
        DB::statement('DROP TYPE IF EXISTS payment_status');
    }
};

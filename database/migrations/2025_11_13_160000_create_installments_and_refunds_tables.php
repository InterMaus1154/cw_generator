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
        // Create Postgres ENUM type for installment_payment_status if not exists
        DB::statement("DO $$
        BEGIN
            IF NOT EXISTS (SELECT 1 FROM pg_type WHERE typname = 'installment_payment_status') THEN
                CREATE TYPE installment_payment_status AS ENUM ('PAID', 'OVERDUE', 'PENDING', 'CANCELLED');
            END IF;
        END$$;");

        Schema::create('installments', function (Blueprint $table) {
            $table->id('inst_id');
            $table->unsignedBigInteger('inv_id');
            $table->smallInteger('inst_number')->unsigned();
            $table->date('inst_due_date');
            $table->date('inst_paid_date')->nullable();
            // enum column added via raw SQL below to ensure PG enum usage

            $table->unique(['inv_id', 'inst_number']);
            $table->foreign('inv_id')->references('inv_id')->on('invoices')->restrictOnDelete();
        });

        // Add enum column using Postgres type
        DB::statement("ALTER TABLE installments ADD COLUMN inst_status installment_payment_status NOT NULL DEFAULT 'PENDING'");

        // create index on inst_status (column now exists)
        DB::statement("CREATE INDEX IF NOT EXISTS idx_installment_status ON installments (inst_status)");

        // add check for inst_number > 0
        DB::statement("ALTER TABLE installments ADD CONSTRAINT chk_inst_number_positive CHECK (inst_number > 0)");

        // refunds
        Schema::create('refunds', function (Blueprint $table) {
            $table->id('refund_id');
            $table->unsignedBigInteger('inv_id');
            $table->unsignedBigInteger('refunded_by');
            $table->decimal('refund_amount', 10, 2);
            $table->text('refund_reason')->nullable();

            $table->foreign('inv_id')->references('inv_id')->on('invoices')->restrictOnDelete();
            $table->foreign('refunded_by')->references('staff_id')->on('staff')->restrictOnDelete();

            $table->index('inv_id', 'idx_refund_invoice');
        });

        DB::statement("ALTER TABLE refunds ADD CONSTRAINT chk_refund_amount_positive CHECK (refund_amount > 0)");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('installments');
        Schema::dropIfExists('refunds');
        DB::statement('DROP TYPE IF EXISTS installment_payment_status');
    }
};

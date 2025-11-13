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
            IF NOT EXISTS (SELECT 1 FROM pg_type WHERE typname = 'transfer_status') THEN
                CREATE TYPE transfer_status AS ENUM ('REQUESTED', 'IN_PROGRESS', 'COMPLETED', 'CANCELLED', 'REJECTED');
            END IF;
        END$$;");

        Schema::create('part_transfers', function (Blueprint $table) {
            $table->id('transfer_id');
            $table->unsignedBigInteger('part_id');
            $table->unsignedBigInteger('from_branch_id');
            $table->unsignedBigInteger('to_branch_id');
            $table->unsignedBigInteger('requested_by');
            $table->date('requested_at');
            $table->unsignedBigInteger('approved_by');
            $table->smallInteger('quantity')->unsigned();
            $table->date('transfer_date');
            $table->text('transfer_note')->nullable();

            $table->foreign('part_id')->references('part_id')->on('parts')->restrictOnDelete();
            $table->foreign('from_branch_id')->references('branch_id')->on('branches')->restrictOnDelete();
            $table->foreign('to_branch_id')->references('branch_id')->on('branches')->restrictOnDelete();
            $table->foreign('requested_by')->references('staff_id')->on('staff')->restrictOnDelete();
            $table->foreign('approved_by')->references('staff_id')->on('staff')->restrictOnDelete();
        });

        DB::statement("ALTER TABLE part_transfers ADD COLUMN transfer_status transfer_status NOT NULL DEFAULT 'REQUESTED'");
        DB::statement('ALTER TABLE part_transfers ADD CONSTRAINT chk_part_transfers_branch_diff CHECK (from_branch_id <> to_branch_id)');
        DB::statement('ALTER TABLE part_transfers ADD CONSTRAINT chk_part_transfers_quantity_positive CHECK (quantity > 0)');
        DB::statement('ALTER TABLE part_transfers ADD CONSTRAINT chk_part_transfers_dates CHECK (requested_at <= transfer_date)');

        DB::statement('CREATE INDEX IF NOT EXISTS idx_part_transfer_status_to_branch ON part_transfers (to_branch_id, transfer_status)');
        DB::statement('CREATE INDEX IF NOT EXISTS idx_part_transfer_status_from_branch ON part_transfers (from_branch_id, transfer_status)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('part_transfers');
        DB::statement('DROP TYPE IF EXISTS transfer_status');
    }
};

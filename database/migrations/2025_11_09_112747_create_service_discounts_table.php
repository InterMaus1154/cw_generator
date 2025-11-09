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
        Schema::create('service_discounts', function (Blueprint $table) {
            $table->id('disc_id');
            $table->integer('service_id');
            $table->decimal('disc_amount', 6, 2);
            $table->date('disc_from');
            $table->date('disc_to');
            $table->boolean('is_active')->default(true);

            // Foreign key
            $table->foreign('service_id')
                ->references('service_id')
                ->on('services')
                ->onDelete('cascade');

            // Indexes
            $table->index(['disc_from', 'disc_to'], 'idx_service_discount_for_period');
            $table->index(['service_id', 'disc_from', 'disc_to'], 'idx_service_discount_for_service_period');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_discounts');
    }
};

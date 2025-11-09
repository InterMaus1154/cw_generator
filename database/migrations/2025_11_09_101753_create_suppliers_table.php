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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id('sup_id'); // SERIAL PRIMARY KEY
            $table->string('sup_name', 100);
            $table->string('sup_contact_name', 60)->nullable();
            $table->char('sup_contact_phone', 15)->nullable();
            $table->char('sup_company_phone', 15);
            $table->string('sup_address_first', 100);
            $table->string('sup_address_second', 100)->nullable();
            $table->char('sup_postcode', 8);
            $table->foreignId('sup_city')->constrained('cities', 'city_id');
            $table->boolean('is_active')->default(true);

            // Indexes
            $table->index('sup_name', 'idx_supplier_name');
            $table->index(['sup_postcode', 'sup_city'], 'idx_supplier_location');
            $table->index('sup_city', 'idx_supplier_city');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};

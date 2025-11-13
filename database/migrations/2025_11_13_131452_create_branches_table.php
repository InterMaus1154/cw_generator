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
        Schema::create('branches', function (Blueprint $table) {
            $table->id('branch_id');
            $table->char('branch_code', 7)->unique();
            $table->string('branch_name', 100)->unique();
            $table->char('branch_phone', 15);
            $table->string('branch_email', 200)->unique();
            $table->string('branch_address_first', 100);
            $table->string('branch_address_second', 100)->nullable();
            $table->char('branch_postcode', 8);
            $table->foreignId('branch_city')->references('city_id')->on('cities')->restrictOnDelete();

            $table->index(['branch_city', 'branch_postcode'], 'idx_branch_location');
            $table->index('branch_postcode', 'idx_branch_postcode');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branches');
    }
};

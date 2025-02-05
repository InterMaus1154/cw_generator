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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->increments('vehicle_id');
            $table->unsignedInteger('cust_id');
            $table->foreign('cust_id')->references('cust_id')->on('customers');
            $table->string('vehicle_plate_number', 10)->unique();
            $table->string('vehicle_brand', 50);
            $table->string('vehicle_model', 50);
            $table->string('vehicle_color', 20)->nullable();
            $table->enum('vehicle_fuel_type', ['diesel', 'petrol', 'hybrid', 'electric']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};

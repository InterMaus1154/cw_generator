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
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('cust_id');
            $table->string('cust_firstname', 50);
            $table->string('cust_midname', 50)->nullable();
            $table->string('cust_lastname', 50);
            $table->string('cust_email', 175)->unique();
            $table->string('cust_contact_number', 15)->unique();
            $table->string('cust_address_first', 100);
            $table->string('cust_address_second', 100)->nullable();
            $table->string('cust_city', 75);
            $table->string('cust_postcode', 8);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};

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
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('emp_id');
            $table->string('emp_firstname', 50);
            $table->string('emp_midname', 50)->nullable();
            $table->string('emp_lastname', 50);
            $table->string('emp_email', 175)->unique();
            $table->string('emp_contact_number', 15)->unique();
            $table->string('emp_address_first', 100);
            $table->string('emp_address_second', 100)->nullable();
            $table->string('emp_city', 75);
            $table->string('emp_postcode', 8);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};

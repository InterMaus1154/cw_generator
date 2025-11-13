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
            $table->id('cust_id');
            $table->integer('mship_id')->nullable();
            $table->date('mship_start_date')->nullable();
            $table->date('mship_end_date')->nullable();
            $table->boolean('mship_auto_renew')->nullable();
            $table->string('cust_fname', 50);
            $table->string('cust_lname', 50);
            $table->string('cust_email', 150)->unique();
            $table->char('cust_contact_num', 15)->unique();
            $table->string('cust_address_first', 100);
            $table->string('cust_address_second', 100)->nullable();
            $table->integer('cust_city');
            $table->char('cust_postcode', 8);

            // Foreign keys
            $table->foreign('mship_id')
                ->references('mship_id')
                ->on('memberships')
                ->onDelete('set null');

            $table->foreign('cust_city')
                ->references('city_id')
                ->on('cities')
                ->onDelete('restrict');

            $table->index(['cust_lname', 'cust_fname'], 'idx_customer_name');
            $table->index('cust_email', 'idx_customer_email');
            $table->index(['cust_postcode', 'cust_lname'], 'idx_customer_postcode_lastname');
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

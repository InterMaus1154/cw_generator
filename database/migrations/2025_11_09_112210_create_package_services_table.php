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
            Schema::create('package_services', function (Blueprint $table) {
                $table->integer('pkg_id');
                $table->integer('service_id');

                // Primary key (composite)
                $table->primary(['pkg_id', 'service_id']);

                // Foreign keys
                $table->foreign('pkg_id')
                    ->references('pkg_id')
                    ->on('packages')
                    ->onDelete('cascade');

                $table->foreign('service_id')
                    ->references('service_id')
                    ->on('services')
                    ->onDelete('cascade');
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('package_services');
    }
};

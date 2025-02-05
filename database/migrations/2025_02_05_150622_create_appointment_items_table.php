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
        Schema::create('appointment_items', function (Blueprint $table) {
            $table->unsignedInteger('inv_item_id');
            $table->unsignedInteger('appt_id');
            $table->integer('qty_used');

            $table->primary(['inv_item_id', 'appt_id']);
            $table->foreign('inv_item_id')->references('inv_item_id')->on('inventory_items');
            $table->foreign('appt_id')->references('appt_id')->on('appointments');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointment_items');
    }
};

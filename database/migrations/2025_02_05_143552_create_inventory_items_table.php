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
        Schema::create('inventory_items', function (Blueprint $table) {
            $table->increments('inv_item_id');
            $table->string('inv_item_name', 250);
            $table->string('inv_item_barcode', 150)->unique();
            $table->integer('inv_item_qty');
            $table->decimal('inv_item_price', 8, 2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invetory_items');
    }
};

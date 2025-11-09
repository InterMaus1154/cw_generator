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
        Schema::create('parts', function (Blueprint $table) {
            $table->id('part_id');
            $table->unsignedBigInteger('part_cat_id');
            $table->string('part_name', 100);
            $table->text('part_description')->nullable();
            $table->decimal('part_price', 10, 2);

            $table->foreign('part_cat_id')
                ->references('part_cat_id')
                ->on('part_categories')
                ->onDelete('cascade');

            $table->index('part_cat_id', 'idx_part_cat');
            $table->index('part_name', 'idx_part_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parts');
    }
};

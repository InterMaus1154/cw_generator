<?php

namespace Database\Seeders;

use App\Models\Part;
use App\Models\Supplier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PartSupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $parts = Part::all();
        $suppliers = Supplier::all();

        $partSuppliers = [];
        $existingCombinations = [];

        foreach ($parts as $part) {
            // Ensure each part has at least 1 supplier
            $numberOfSuppliers = rand(1, min(5, $suppliers->count()));

            // Get random suppliers for this part
            $randomSuppliers = $suppliers->random($numberOfSuppliers);

            foreach ($randomSuppliers as $supplier) {
                // Create unique key to check for duplicates
                $key = $part->part_id . '-' . $supplier->sup_id;

                // Skip if this combination already exists
                if (isset($existingCombinations[$key])) {
                    continue;
                }

                $existingCombinations[$key] = true;

                $partSuppliers[] = [
                    'part_id' => $part->part_id,
                    'sup_id' => $supplier->sup_id,
                    'unit_cost' => fake()->randomFloat(2, 1.00, 999.99),
                    'min_order_quantity' => fake()->numberBetween(0, 20),
                ];
            }
        }
        DB::table('part_suppliers')->insert($partSuppliers);
    }
}

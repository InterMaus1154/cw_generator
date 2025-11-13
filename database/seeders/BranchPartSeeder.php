<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Branch;
use App\Models\Part;

class BranchPartSeeder extends Seeder
{
    public function run(): void
    {
        $branches = Branch::all();
        $parts = Part::all();
        if ($branches->isEmpty() || $parts->isEmpty()) return;

        foreach ($branches as $branch) {
            // each branch carries 30-60% of parts
            $count = (int) round($parts->count() * (rand(30, 60) / 100));
            $selected = $parts->random($count);
            foreach ($selected as $part) {
                DB::table('branch_parts')->insertOrIgnore([
                    'branch_id' => $branch->branch_id,
                    'part_id' => $part->part_id,
                    'quantity' => rand(0, 200),
                ]);
            }
        }
    }
}

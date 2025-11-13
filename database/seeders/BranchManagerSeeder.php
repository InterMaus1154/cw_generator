<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Branch;
use App\Models\BranchManager;

class BranchManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $branches = Branch::all();

        foreach ($branches as $branch) {
            $staffs = $branch->staff()->get();
            if ($staffs->isEmpty()) {
                continue;
            }

            // Ensure at least one active manager per branch
            $active = $staffs->random();
            BranchManager::factory()->create([
                'branch_id' => $branch->branch_id,
                'staff_id' => $active->staff_id,
                'is_active' => true,
                'assigned_at' => now()->subDays(rand(1, 3650))->format('Y-m-d')
            ]);

            // Optionally add a previous inactive manager
            if (random_int(0, 100) < 30) {
                $prev = $staffs->where('staff_id', '!=', $active->staff_id)->random();
                BranchManager::factory()->create([
                    'branch_id' => $branch->branch_id,
                    'staff_id' => $prev->staff_id,
                    'is_active' => false,
                    'assigned_at' => now()->subDays(rand(365, 3650))->format('Y-m-d')
                ]);
            }
        }
    }
}

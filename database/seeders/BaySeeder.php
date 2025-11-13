<?php

namespace Database\Seeders;

use App\Models\Bay;
use App\Models\Branch;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (Branch::all() as $branch) {
            $numBays = fake()->numberBetween(5, 10);

            Bay::factory()
                ->count($numBays)
                ->create([
                    'branch_id' => $branch->branch_id,
                ]);
        }
    }
}

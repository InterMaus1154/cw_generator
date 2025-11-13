<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Bay;
use App\Models\BayInspection;

class BayInspectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bays = Bay::all();

        foreach ($bays as $bay) {
            $count = random_int(0, 3);
            if ($count === 0) continue;

            BayInspection::factory()->count($count)->create([
                'bay_id' => $bay->bay_id
            ]);
        }
    }
}

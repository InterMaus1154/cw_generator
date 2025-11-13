<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Job;
use App\Models\Part;

class PartUsageSeeder extends Seeder
{
    public function run(): void
    {
        $jobs = Job::all();
        $parts = Part::all();
        if ($jobs->isEmpty() || $parts->isEmpty()) return;

        foreach ($jobs as $job) {
            // Ensure at least one part per job
            $first = $parts->random();
            DB::table('part_usage')->insertOrIgnore([
                'job_id' => $job->job_id,
                'part_id' => $first->part_id,
                'quantity' => rand(1, 5),
            ]);

            // add 0..3 additional parts randomly
            $extra = rand(0, 3);
            $others = $parts->where('part_id', '!=', $first->part_id)->shuffle()->take($extra);
            foreach ($others as $p) {
                DB::table('part_usage')->insertOrIgnore([
                    'job_id' => $job->job_id,
                    'part_id' => $p->part_id,
                    'quantity' => rand(1, 8),
                ]);
            }
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Job;
use App\Models\Service;

class AdditionalServiceSeeder extends Seeder
{
    public function run(): void
    {
        $jobs = Job::all();
        if ($jobs->isEmpty()) return;

        foreach ($jobs as $job) {
            if (random_int(1, 100) > random_int(30, 35)) continue; // 30-35% chance

            $service = Service::inRandomOrder()->first();
            if (! $service) continue;

            // avoid duplicates for same (job_id, service_id)
            $exists = DB::table('additional_services')->where('job_id', $job->job_id)->where('service_id', $service->service_id)->exists();
            if ($exists) continue;

            DB::table('additional_services')->insert([
                'job_id' => $job->job_id,
                'service_id' => $service->service_id,
                'note' => 'Technician noted additional work: ' . substr((string) bin2hex(random_bytes(8)), 0, 20)
            ]);
        }
    }
}

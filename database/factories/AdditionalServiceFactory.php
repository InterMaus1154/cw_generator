<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Job;
use App\Models\Service;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AdditionalService>
 */
class AdditionalServiceFactory extends Factory
{
    public function definition(): array
    {
        $job = Job::inRandomOrder()->first();
        $service = Service::inRandomOrder()->first();

        return [
            'job_id' => $job ? $job->job_id : Job::factory(),
            'service_id' => $service ? $service->service_id : Service::factory(),
            'note' => $this->faker->sentence(8),
        ];
    }
}

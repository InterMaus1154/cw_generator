<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Job;
use App\Models\Part;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PartUsage>
 */
class PartUsageFactory extends Factory
{
    public function definition(): array
    {
        $job = Job::inRandomOrder()->first();
        $part = Part::inRandomOrder()->first();

        return [
            'job_id' => $job ? $job->job_id : Job::factory(),
            'part_id' => $part ? $part->part_id : Part::factory(),
            'quantity' => $this->faker->numberBetween(1, 10),
        ];
    }
}

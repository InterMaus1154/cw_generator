<?php

namespace Database\Factories;

use App\Models\Bay;
use App\Models\Staff;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BayInspection>
 */
class BayInspectionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $bay = Bay::inRandomOrder()->first();
        $inspector = Staff::inRandomOrder()->first();

        $inspectionDate = $this->faker->dateTimeBetween('-2 years', 'now');
        $nextDue = $this->faker->dateTimeBetween($inspectionDate->modify('+30 days'), '+2 years');

        return [
            'bay_id' => $bay ? $bay->bay_id : Bay::factory(),
            'inspected_by' => $inspector ? $inspector->staff_id : Staff::factory(),
            'inspection_date' => $inspectionDate->format('Y-m-d'),
            'inspection_next_due_date' => $nextDue->format('Y-m-d'),
            'inspection_status' => $this->faker->randomElement(['PENDING','IN_PROGRESS','PASSED','FAILED','REINSPECTION_DUE','CANCELLED']),
            'inspection_remarks' => $this->faker->sentences(asText: true)
        ];
    }
}

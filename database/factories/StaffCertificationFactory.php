<?php

namespace Database\Factories;

use App\Models\Staff;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StaffCertification>
 */
class StaffCertificationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $levels = ['TRAINEE', 'LEVEL_1', 'LEVEL_2', 'LEVEL_3', 'MASTER_TECHNICIAN'];
        $level = $this->faker->randomElement($levels);

        $names = [
            'NVQ Automotive Technology',
            'Advanced Diagnostics',
            'Brake Systems Specialist',
            'Transmission Repair Certificate',
            'Hybrid & Electric Systems',
            'Air Conditioning Technician',
            'Vehicle Painting & Finishing',
        ];

        return [
            'staff_id' => Staff::factory(),
            'cert_level' => $level,
            'cert_name' => $this->faker->randomElement($names),
        ];
    }
}

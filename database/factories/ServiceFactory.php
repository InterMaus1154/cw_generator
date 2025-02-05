<?php

namespace Database\Factories;

use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $services = [

        ];

        return [
            'dept_id' => Department::factory(),
            'service_name' => '',
            'service_price' => $this->faker->randomFloat(2, 20, 99999)
        ];
    }
}

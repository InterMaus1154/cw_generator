<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Role>
 */
class RoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $roles = [
            'Painter',
            'Electric Technician',
            'Human Resources',
            'Tire Technician',
            'Department Manager',
            'Transmission Technician',
            'Receptionist',
            'Inventory Manager',
            'Accountant',
            'Service Advisor',
            'Performance Tuning',
            'Engine Technician',
            'Sound Systems Technician',
            'Cleaning Technician',
            'Oil & Lube Technician',
            'Polishing Technician'
        ];

        return [
            'role_name' => $this->faker->unique()->randomElement($roles)
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bay>
 */
class BayFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // 90% chance available, rest distributed
        $statusPool = array_merge(
            array_fill(0, 90, 'AVAILABLE'),
            array_fill(0, 5, 'OCCUPIED'),
            array_fill(0, 3, 'UNDER_MAINTENANCE'),
            array_fill(0, 1, 'RESERVED'),
            array_fill(0, 1, 'INACTIVE')
        );

        $capacity = fake()->randomElement([1, 1, 1, 1, 2]); // 20% chance of 2

        return [
            'bay_name'     => 'Bay ' . fake()->unique()->numberBetween(1, 999),
            'bay_capacity' => $capacity,
            'bay_status'   => fake()->randomElement($statusPool),
        ];
    }
}

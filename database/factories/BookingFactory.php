<?php

namespace Database\Factories;

use App\Models\Vehicle;
use App\Models\Branch;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Booking dates between 2023-01-01 and 2026-12-31
        $date = $this->faker->dateTimeBetween('2023-01-01', '2026-12-31');
        return [
            'vec_id' => Vehicle::inRandomOrder()->first()->vec_id ?? Vehicle::factory(),
            'branch_id' => Branch::inRandomOrder()->first()->branch_id ?? Branch::factory(),
            'booking_date' => $date->format('Y-m-d'),
            'booking_time' => $this->faker->time('H:i'),
            'booking_comments' => $this->faker->optional(0.5)->sentence()
        ];
    }
}

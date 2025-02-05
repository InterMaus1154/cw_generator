<?php

namespace Database\Factories;

use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Appointment>
 */
class AppointmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $appt_remarks = $this->faker->randomElement([0, 1]) === 0 ? $this->faker->realTextBetween(50, 300) : null;
        return [
            'vehicle_id' => Vehicle::all()->random()->vehicle_id,
            'appt_date' => $this->faker->dateTimeBetween(startDate: '-3 years'),
            'appt_time' => $this->faker->time,
            'appt_remarks' => $appt_remarks
        ];
    }
}

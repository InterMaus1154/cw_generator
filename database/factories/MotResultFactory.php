<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Booking;
use App\Models\Staff;
use App\Models\Vehicle;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MotResult>
 */
class MotResultFactory extends Factory
{
    public function definition(): array
    {
        $booking = Booking::inRandomOrder()->first();
        $staff = Staff::inRandomOrder()->first();
        $vehicle = Vehicle::inRandomOrder()->first();

        $testDate = $this->faker->dateTimeBetween('-2 years', 'now');
        $expiry = (clone $testDate)->modify('+1 year');

        return [
            'booking_id' => $booking ? $booking->booking_id : Booking::factory(),
            'vec_id' => $vehicle ? $vehicle->vec_id : Vehicle::factory(),
            'staff_id' => $staff ? $staff->staff_id : Staff::factory(),
            'test_date' => $testDate->format('Y-m-d'),
            'expiry_date' => $expiry->format('Y-m-d'),
            'result' => $this->faker->randomElement(['PASS', 'FAIL', 'PASS_WITH_DEFECTS', 'FAIL_DANGEROUS']),
            'mileage_reading' => $this->faker->numberBetween(1, 300000),
            'comments' => $this->faker->optional(0.8)->sentence(10),
        ];
    }
}

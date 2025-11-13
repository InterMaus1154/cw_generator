<?php

namespace Database\Factories;

use App\Models\Staff;
use App\Models\Bay;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    public function definition(): array
    {
        $bs = DB::table('booking_services')->inRandomOrder()->first();

        $staff = null;
        if ($bs) {
            $booking = DB::table('bookings')->where('booking_id', $bs->booking_id)->first();
            if ($booking && ! empty($booking->branch_id)) {
                $staff = Staff::where('branch_id', $booking->branch_id)->inRandomOrder()->first();
            }
        }
        $staff = $staff ?? Staff::inRandomOrder()->first();

        $bay = Bay::inRandomOrder()->first();

        $assigned = $this->faker->dateTimeBetween('-30 days', '+10 days');
        $due = (clone $assigned)->modify('+' . $this->faker->numberBetween(1, 14) . ' days');

        return [
            'staff_id' => $staff ? $staff->staff_id : Staff::factory(),
            'booking_service_id' => $bs ? $bs->booking_service_id : DB::table('booking_services')->insertGetId(['booking_id' => 1, 'service_id' => 1]),
            'bay_id' => $bay ? $bay->bay_id : Bay::factory(),
            'job_assigned_at' => $assigned->format('Y-m-d'),
            'job_due_at' => $due->format('Y-m-d'),
            'job_start' => null,
            'job_end' => null,
            'job_notes' => $this->faker->optional(0.4)->sentence(),
        ];
    }
}

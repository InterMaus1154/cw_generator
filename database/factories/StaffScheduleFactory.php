<?php

namespace Database\Factories;

use App\Models\Staff;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StaffSchedule>
 */
class StaffScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // ensure start < end by choosing a start hour and adding 4-9 hours for end
        $startHour = $this->faker->numberBetween(6, 12);
        $startMinute = $this->faker->randomElement([0, 0, 0, 15, 30, 45]);
        $durationHours = $this->faker->numberBetween(4, 9);

        $start = sprintf('%02d:%02d:00', $startHour, $startMinute);
        $endHour = $startHour + $durationHours;
        if ($endHour > 23) {
            $endHour = 23;
            $endMinute = 59;
        } else {
            $endMinute = $startMinute;
        }
        $end = sprintf('%02d:%02d:00', $endHour, $endMinute);

        return [
            'staff_id' => Staff::factory(),
            'schedule_day' => $this->faker->randomElement(['MONDAY','TUESDAY','WEDNESDAY','THURSDAY','FRIDAY','SATURDAY','SUNDAY']),
            'schedule_start_time' => $start,
            'schedule_end_time' => $end,
        ];
    }
}

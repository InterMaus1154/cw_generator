<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Staff;
use App\Models\StaffSchedule;

class StaffScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $staffs = Staff::all();

        foreach ($staffs as $staff) {
            // Create between 1 and 5 schedules per staff, unique days
            $days = ['MONDAY','TUESDAY','WEDNESDAY','THURSDAY','FRIDAY','SATURDAY','SUNDAY'];
            shuffle($days);
            $count = random_int(1, 5);
            $chosen = array_slice($days, 0, $count);

            foreach ($chosen as $day) {
                StaffSchedule::factory()->create([
                    'staff_id' => $staff->staff_id,
                    'schedule_day' => $day,
                ]);
            }
        }
    }
}

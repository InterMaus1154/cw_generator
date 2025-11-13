<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Staff;
use App\Models\StaffCertification;

class StaffCertificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $staffs = Staff::all();

        foreach ($staffs as $staff) {
            $count = random_int(0, 3);
            if ($count === 0) {
                continue;
            }

            StaffCertification::factory()->count($count)->create([
                'staff_id' => $staff->staff_id
            ]);
        }
    }
}

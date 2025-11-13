<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Staff;
use Faker\Factory as Faker;

class JobSeeder extends Seeder
{
    public function run(): void
    {
        $bookingServices = DB::table('booking_services')->get();
        if ($bookingServices->isEmpty()) return;

        foreach ($bookingServices as $bs) {
            $booking = DB::table('bookings')->where('booking_id', $bs->booking_id)->first();
            $branchId = $booking->branch_id ?? null;

            // require branch id to exist
            if (! $branchId) continue;

            // pick staff strictly from the booking's branch; skip if none
            $staff = Staff::where('branch_id', $branchId)->inRandomOrder()->first();
            if (! $staff) continue;

            // pick bay from the same branch; skip if none
            $bay = DB::table('bays')->where('branch_id', $branchId)->inRandomOrder()->first();
            if (! $bay) continue;

            // determine whether booking is in the past
            $bookingDate = $booking->booking_date ?? null;
            $isPast = $bookingDate ? (strtotime($bookingDate) < strtotime(date('Y-m-d'))) : false;

            // ensure at least one job per booking_service
            // assign sensible dates depending on whether booking is past
            $faker = Faker::create();
            if ($isPast) {
                // completed job: assign around booking date
                $assigned = date('Y-m-d', strtotime($bookingDate . ' -' . random_int(0, 7) . ' days'));
                $due = date('Y-m-d', strtotime($bookingDate . ' +' . random_int(0, 7) . ' days'));
                // calculate start and end datetimes relative to the assigned date with business-hour times
                $startDate = date('Y-m-d', strtotime($assigned . ' +' . random_int(0, 2) . ' days'));
                $startTime = sprintf('%02d:%02d:00', random_int(8, 16), random_int(0, 59));
                $startDt = strtotime($startDate . ' ' . $startTime);
                $endDt = $startDt + (random_int(1, 3) * 3600 * random_int(4, 8));

                DB::table('jobs')->insert([
                    'staff_id' => $staff->staff_id,
                    'booking_service_id' => $bs->booking_service_id,
                    'bay_id' => $bay->bay_id,
                    'job_assigned_at' => $assigned,
                    'job_due_at' => $due,
                    'job_start' => date('Y-m-d H:i:s', $startDt),
                    'job_end' => date('Y-m-d H:i:s', $endDt),
                    'job_notes' => $faker->sentence(6),
                    'job_status' => 'COMPLETED',
                ]);
            } else {
                // future or current booking: choose a status distribution
                $r = random_int(1, 100);
                if ($r <= 50) {
                    $status = 'SCHEDULED';
                } elseif ($r <= 70) {
                    $status = 'IN_PROGRESS';
                } elseif ($r <= 80) {
                    $status = 'ON_HOLD';
                } elseif ($r <= 90) {
                    $status = 'CANCELLED';
                } else {
                    $status = 'FAILED';
                }

                $assigned = now()->subDays(random_int(0, 3))->format('Y-m-d');
                $due = now()->addDays(random_int(1, 21))->format('Y-m-d');

                $jobStart = null;
                $jobEnd = null;
                if ($status === 'IN_PROGRESS') {
                    // started recently - add a realistic time
                    $startDate = date('Y-m-d', strtotime($assigned . ' +' . random_int(0, 2) . ' days'));
                    $jobStart = date('Y-m-d H:i:s', strtotime($startDate . ' ' . sprintf('%02d:%02d:00', random_int(8, 16), random_int(0, 59))));
                } elseif ($status === 'COMPLETED') {
                    $startDate = date('Y-m-d', strtotime($assigned . ' +' . random_int(0, 2) . ' days'));
                    $jobStart = date('Y-m-d H:i:s', strtotime($startDate . ' ' . sprintf('%02d:%02d:00', random_int(8, 16), random_int(0, 59))));
                    // job end a few hours later
                    $jobEnd = date('Y-m-d H:i:s', strtotime($jobStart) + (3600 * random_int(2, 8)));
                }

                DB::table('jobs')->insert([
                    'staff_id' => $staff->staff_id,
                    'booking_service_id' => $bs->booking_service_id,
                    'bay_id' => $bay->bay_id,
                    'job_assigned_at' => $assigned,
                    'job_due_at' => $due,
                    'job_start' => $jobStart,
                    'job_end' => $jobEnd,
                    'job_notes' => $faker->optional(0.6)->sentence(6),
                    'job_status' => $status,
                ]);
            }

            // Occasionally the job isn't finished by a single staff on the same day.
            // Create 0..2 follow-up job rows for the same booking_service_id
            if (random_int(1, 100) <= 35) { // ~35% chance to have follow-ups
                $followCount = random_int(1, 2);
                $prevAssigned = $assigned;
                $prevDue = $due;
                for ($f = 0; $f < $followCount; $f++) {
                    // decide if same staff works on the follow-up (50%) or another from same branch
                    $useSame = random_int(1, 100) <= 50;
                    $followStaff = $staff;
                    if (! $useSame) {
                        $alt = Staff::where('branch_id', $branchId)->where('staff_id', '!=', $staff->staff_id)->inRandomOrder()->first();
                        if ($alt) $followStaff = $alt;
                        // if no alternative staff in branch, keep original staff
                    }

                    // schedule follow-up after previous due date
                    $prevDueTs = strtotime($prevDue);
                    $assignOffset = random_int(1, 7); // days after previous due
                    $followAssigned = date('Y-m-d', strtotime("+{$assignOffset} days", $prevDueTs));
                    $followDue = date('Y-m-d', strtotime("+" . random_int(1, 7) . " days", strtotime($followAssigned)));

                    // realistic follow-up times
                    $followStartTime = sprintf('%02d:%02d:00', random_int(8, 16), random_int(0, 59));
                    $followStart = date('Y-m-d H:i:s', strtotime($followAssigned . ' ' . $followStartTime));
                    $followEnd = date('Y-m-d H:i:s', strtotime($followStart) + (3600 * random_int(2, 6)));

                    DB::table('jobs')->insert([
                        'staff_id' => $followStaff->staff_id,
                        'booking_service_id' => $bs->booking_service_id,
                        'bay_id' => $bay->bay_id,
                        'job_assigned_at' => $followAssigned,
                        'job_due_at' => $followDue,
                        'job_start' => $followStart,
                        'job_end' => $followEnd,
                        'job_notes' => $faker->sentence(6) . ' (' . ($useSame ? 'continued by same staff' : 'handed over to another staff') . ')',
                    ]);

                    $prevAssigned = $followAssigned;
                    $prevDue = $followDue;
                }
            }
        }
    }
}

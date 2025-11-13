<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\Service;
use App\Models\Booking;
use App\Models\BookingService;
use App\Models\Staff;
use App\Models\Vehicle;

class MotResultSeeder extends Seeder
{
    /**
     * Create MOT results for bookings that have MOT service.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Ensure an MOT service exists
        $mot = Service::where('service_name', 'like', '%MOT%')->first();
        if (! $mot) {
            $motId = DB::table('services')->insertGetId([
                'dept_id' => DB::table('departments')->inRandomOrder()->first()->dept_id ?? 1,
                'service_name' => 'MOT Test',
                'service_price' => 59.99
            ]);
            $mot = Service::find($motId);
        }

        // Attach MOT service to a subset of bookings (say 10%) if not already attached
        $bookings = Booking::all();
        foreach ($bookings as $b) {
            if (random_int(1, 100) > 10) continue;
            $exists = DB::table('booking_services')->where('booking_id', $b->booking_id)->where('service_id', $mot->service_id)->exists();
            if (! $exists) {
                DB::table('booking_services')->insert([
                    'booking_id' => $b->booking_id,
                    'service_id' => $mot->service_id
                ]);
            }
        }

        // For bookings that have MOT attached, create a mot_result
        $bsRows = DB::table('booking_services')->where('service_id', $mot->service_id)->get();
        foreach ($bsRows as $bs) {
            $booking = Booking::find($bs->booking_id);
            if (! $booking) continue;
            $vehicle = Vehicle::find($booking->vec_id) ?? Vehicle::inRandomOrder()->first();
            $staff = Staff::where('branch_id', $booking->branch_id)->inRandomOrder()->first() ?? Staff::inRandomOrder()->first();
            if (! $staff || ! $vehicle) continue;

            $testDate = $faker->dateTimeBetween('-2 years', 'now');
            $expiry = (clone $testDate)->modify('+1 year');

            $comment = $faker->optional(0.9)->sentence(12) ?? 'MOT test recorded';

            DB::table('mot_results')->insert([
                'booking_id' => $booking->booking_id,
                'vec_id' => $vehicle->vec_id,
                'staff_id' => $staff->staff_id,
                'test_date' => $testDate->format('Y-m-d'),
                'expiry_date' => $expiry->format('Y-m-d'),
                'result' => $faker->randomElement(['PASS', 'FAIL', 'PASS_WITH_DEFECTS', 'FAIL_DANGEROUS']),
                'mileage_reading' => $faker->numberBetween(1, 300000),
                'comments' => $comment,
            ]);
        }
    }
}

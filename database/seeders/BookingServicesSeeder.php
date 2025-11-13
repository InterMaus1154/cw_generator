<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Booking;
use App\Models\Service;

class BookingServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = Service::all();
        $bookings = Booking::all();

        if ($services->isEmpty() || $bookings->isEmpty()) {
            return;
        }

        foreach ($bookings as $booking) {
            // Skip bookings that already have packages (we prefer packages over individual services)
            $hasPackage = DB::table('booking_packages')->where('booking_id', $booking->booking_id)->exists();
            if ($hasPackage) {
                continue;
            }

            // Assign 1-3 distinct services to the booking
            $count = random_int(1, min(5, $services->count()));
            $chosen = $services->random($count);

            foreach ($chosen as $svc) {
                DB::table('booking_services')->insertOrIgnore([
                    'booking_id' => $booking->booking_id,
                    'service_id' => $svc->service_id
                ]);
            }
        }
    }
}

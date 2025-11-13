<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Booking;
use App\Models\Package;
use Illuminate\Support\Facades\DB;

class BookingPackagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $packages = Package::all();
        $bookings = Booking::all();

        if ($packages->isEmpty() || $bookings->isEmpty()) {
            return;
        }

        // Rare: about 10% of bookings have one or more packages
        $bookingsWithPackages = $bookings->random(max(1, (int) floor($bookings->count() * 0.1)));

        foreach ($bookingsWithPackages as $booking) {
            $count = random_int(1, min(3, $packages->count()));
            $chosen = $packages->random($count);
            foreach ($chosen as $pkg) {
                DB::table('booking_packages')->insertOrIgnore([
                    'booking_id' => $booking->booking_id,
                    'pkg_id' => $pkg->pkg_id
                ]);
            }
        }
    }
}

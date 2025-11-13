<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Vehicle;
use App\Models\Booking;
use App\Models\Branch;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * Distribution assumptions:
     * - 50% of vehicles get 1 booking
     * - 25% of vehicles get between 2-5 bookings
     * - 25% of vehicles get between 5-10 bookings
     */
    public function run(): void
    {
        $vehicles = Vehicle::all();
        $total = $vehicles->count();
        if ($total === 0) {
            return;
        }

        $shuffled = $vehicles->shuffle();

        $firstCount = (int) floor($total * 0.5);
        $secondCount = (int) floor($total * 0.25);
        $thirdCount = $total - $firstCount - $secondCount;

        $first = $shuffled->slice(0, $firstCount);
        $second = $shuffled->slice($firstCount, $secondCount);
        $third = $shuffled->slice($firstCount + $secondCount, $thirdCount);

        $branches = Branch::all();

        // First group: 1 booking each
        foreach ($first as $veh) {
            $branch = $branches->random();
            Booking::factory()->create(['vec_id' => $veh->vec_id, 'branch_id' => $branch->branch_id]);
        }

        // Second group: 2-5 bookings randomly
        foreach ($second as $veh) {
            $count = random_int(2, 5);
            for ($i = 0; $i < $count; $i++) {
                $branch = $branches->random();
                Booking::factory()->create(['vec_id' => $veh->vec_id, 'branch_id' => $branch->branch_id]);
            }
        }

        // Third group: 5-10 bookings randomly
        foreach ($third as $veh) {
            $count = random_int(5, 10);
            for ($i = 0; $i < $count; $i++) {
                $branch = $branches->random();
                Booking::factory()->create(['vec_id' => $veh->vec_id, 'branch_id' => $branch->branch_id]);
            }
        }

        // Ensure each branch has bookings across years 2023..2026
        foreach ($branches as $branch) {
            for ($year = 2023; $year <= 2026; $year++) {
                $exists = Booking::where('branch_id', $branch->branch_id)
                    ->whereYear('booking_date', $year)
                    ->exists();
                if (! $exists) {
                    // create one booking in that year for a random vehicle
                    $veh = $vehicles->random();
                    $date = sprintf('%d-%02d-%02d', $year, random_int(1, 12), random_int(1, 28));
                    Booking::factory()->create([
                        'vec_id' => $veh->vec_id,
                        'branch_id' => $branch->branch_id,
                        'booking_date' => $date
                    ]);
                }
            }
        }
    }
}

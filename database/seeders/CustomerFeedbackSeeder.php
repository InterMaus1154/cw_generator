<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\Booking;
use App\Models\CustomerFeedback;

class CustomerFeedbackSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();
        $bookings = Booking::all();
        if ($bookings->isEmpty()) return;

        foreach ($bookings as $b) {
            if (random_int(1, 100) > 15) continue; // ~15% of bookings get feedback

            $custId = $b->cust_id ?? DB::table('customers')->inRandomOrder()->first()->cust_id;

            DB::table('customer_feedbacks')->insert([
                'cust_id' => $custId,
                'booking_id' => $b->booking_id,
                'cust_fb_content' => $faker->paragraph(2),
            ]);
        }
    }
}

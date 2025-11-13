<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Booking;
use App\Models\Invoice;
use App\Models\Refund;
use App\Models\Staff;
use Faker\Factory as Faker;

class RefundSeeder extends Seeder
{
    /**
     * Create refunds for ~5% of bookings. A refund references an invoice and a staff member.
     */
    public function run(): void
    {
        $bookings = Booking::all();
        if ($bookings->isEmpty()) return;

        foreach ($bookings as $booking) {
            if (random_int(1, 100) > 5) continue; // only 5%

            // find an invoice for this booking if exists
            $invoice = Invoice::where('booking_id', $booking->booking_id)->inRandomOrder()->first();
            if (! $invoice) continue;

            // prefer staff from the same branch as the booking
            $staff = null;
            if (! empty($booking->branch_id)) {
                $staff = Staff::where('branch_id', $booking->branch_id)->inRandomOrder()->first();
            }
            // fallback to any staff
            $staff = $staff ?? Staff::inRandomOrder()->first();
            if (! $staff) continue;

            $faker = Faker::create();

            $inv_final = max(0.01, (float) ($invoice->inv_final ?? 0.01));
            // choose a refund amount between 1% and 90% of invoice final (but not exceeding inv_final)
            $minAmount = max(0.01, round($inv_final * 0.01, 2));
            $maxAmount = max($minAmount, round($inv_final * 0.9, 2));
            $amount = round($faker->randomFloat(2, $minAmount, $maxAmount), 2);

            // reasonable refund reasons
            $reasons = [
                'Service cancelled by customer',
                'Overcharge adjustment',
                'Parts replaced under warranty',
                'Duplicate charge refund',
                'Customer dissatisfaction - partial refund',
                'Incorrect service applied',
                'Promotional discount correction',
                'Prepayment adjustment'
            ];

            Refund::create([
                'inv_id' => $invoice->inv_id,
                'refunded_by' => $staff->staff_id,
                'refund_amount' => min($amount, $inv_final),
                'refund_reason' => $faker->randomElement($reasons)
            ]);
        }
    }
}

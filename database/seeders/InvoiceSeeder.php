<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Booking;
use App\Models\Invoice;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * Create invoices for bookings. Distribution:
     * - ~80% of bookings get an invoice
     * - Status distribution: PAID (60%), PENDING (25%), OVERDUE (15%)
     */
    public function run(): void
    {
        $bookings = Booking::all();
        if ($bookings->isEmpty()) {
            return;
        }

        foreach ($bookings as $booking) {
            if (random_int(1, 100) > 80) {
                continue; // ~20% no invoice
            }

            $issueDate = $booking->booking_date ?? now()->format('Y-m-d');
            $dueDays = random_int(7, 30);
            $dueDate = date('Y-m-d', strtotime($issueDate . " +{$dueDays} days"));

            $inv = Invoice::factory()->create([
                'booking_id' => $booking->booking_id,
                'inv_issue_date' => $issueDate,
                'inv_due_date' => $dueDate,
            ]);

            // choose status distribution
            $r = random_int(1, 100);
            if ($r <= 60) {
                $status = 'PAID';
            } elseif ($r <= 85) {
                $status = 'PENDING';
            } else {
                $status = 'OVERDUE';
            }

            // update enum column using raw SQL to avoid casting issues
            \DB::table('invoices')->where('inv_id', $inv->inv_id)->update(['inv_status' => $status]);
        }
    }
}

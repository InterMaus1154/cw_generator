<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Invoice;
use App\Models\Installment;

class InstallmentSeeder extends Seeder
{
    /**
     * Create installments for a subset of invoices.
     * Only 10% of invoices should have installments. For those invoices, create 2-6 installments summing to inv_final.
     */
    public function run(): void
    {
        $invoices = Invoice::all();
        if ($invoices->isEmpty()) return;

        foreach ($invoices as $inv) {
            if (random_int(1, 100) > 10) {
                continue; // only 10% get installments
            }

            $count = random_int(2, 6);
            $remaining = (float) max(0.01, $inv->inv_final ?? 0.0);
            $parts = [];
            // Build random partition of amount across $count installments
            for ($i = 0; $i < $count; $i++) {
                if ($i == $count - 1) {
                    $parts[] = round($remaining, 2);
                } else {
                    $max = max(0.01, $remaining - ($count - $i - 1) * 0.01);
                    $val = round($this->randomFloat(0.01, $max * 0.8), 2);
                    $parts[] = $val;
                    $remaining -= $val;
                }
            }

            // create installments with increasing due dates
            $start = strtotime($inv->inv_due_date ?? now()->format('Y-m-d'));
            for ($n = 0; $n < $count; $n++) {
                Installment::create([
                    'inv_id' => $inv->inv_id,
                    'inst_number' => $n + 1,
                    'inst_due_date' => date('Y-m-d', strtotime("+" . ($n * 30) . " days", $start)),
                    'inst_paid_date' => (random_int(1, 100) <= 60) ? date('Y-m-d', strtotime("+" . ($n * 30) . " days", $start)) : null,
                    'inst_status' => (random_int(1, 100) <= 60) ? 'PAID' : (random_int(1, 100) <= 50 ? 'PENDING' : 'OVERDUE'),
                ]);
            }
        }
    }

    private function randomFloat($min, $max)
    {
        return $min + lcg_value() * ($max - $min);
    }
}

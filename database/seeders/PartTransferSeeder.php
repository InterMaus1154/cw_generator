<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Part;
use App\Models\Branch;
use App\Models\Staff;
use Faker\Factory as Faker;

class PartTransferSeeder extends Seeder
{
    public function run(): void
    {
        $parts = Part::all();
        $branches = Branch::all();
        if ($parts->isEmpty() || $branches->count() < 2) return;

        // create a number of random transfer requests
        $count = 1000;
        $faker = Faker::create();
        $minDate = strtotime('2023-01-01');
        $maxDate = strtotime('2025-11-13');
        for ($i = 0; $i < $count; $i++) {
            $from = $branches->random();
            $to = $branches->where('branch_id', '!=', $from->branch_id)->random();
            $part = $parts->random();

            $requestedBy = Staff::where('branch_id', $to->branch_id)->inRandomOrder()->first();
            if (! $requestedBy) continue;
            $approvedBy = Staff::where('branch_id', $from->branch_id)->inRandomOrder()->first();
            if (! $approvedBy) continue;

            // requested date between 2023-01-01 and max
            $requestedTs = rand($minDate, $maxDate);
            // transfer date must be >= requestedAt and <= maxDate
            $transferTs = rand($requestedTs, $maxDate);

            $requestedAt = date('Y-m-d', $requestedTs);
            $transferDate = date('Y-m-d', $transferTs);

            $statuses = ['REQUESTED', 'IN_PROGRESS', 'COMPLETED', 'CANCELLED', 'REJECTED'];
            $status = $faker->randomElement($statuses);

            DB::table('part_transfers')->insert([
                'part_id' => $part->part_id,
                'from_branch_id' => $from->branch_id,
                'to_branch_id' => $to->branch_id,
                'requested_by' => $requestedBy->staff_id,
                'requested_at' => $requestedAt,
                'approved_by' => $approvedBy->staff_id,
                'quantity' => rand(1, 50),
                'transfer_date' => $transferDate,
                'transfer_status' => $status,
                'transfer_note' => $faker->optional(0.8)->sentence(8),
            ]);
        }
    }
}

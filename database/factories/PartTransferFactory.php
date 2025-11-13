<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Part;
use App\Models\Branch;
use App\Models\Staff;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PartTransfer>
 */
class PartTransferFactory extends Factory
{
    public function definition(): array
    {
        $part = Part::inRandomOrder()->first();
        $fromBranch = Branch::inRandomOrder()->first();
        $toBranch = Branch::where('branch_id', '!=', $fromBranch->branch_id)->inRandomOrder()->first() ?? $fromBranch;

        // requested_by must belong to to_branch, approved_by must belong to from_branch
        $requestedBy = Staff::where('branch_id', $toBranch->branch_id)->inRandomOrder()->first() ?? Staff::inRandomOrder()->first();
        $approvedBy = Staff::where('branch_id', $fromBranch->branch_id)->inRandomOrder()->first() ?? Staff::inRandomOrder()->first();

        $requestedAt = $this->faker->dateTimeBetween('-30 days', 'now')->format('Y-m-d');
        $transferDate = $this->faker->dateTimeBetween($requestedAt, '+10 days')->format('Y-m-d');

        return [
            'part_id' => $part ? $part->part_id : Part::factory(),
            'from_branch_id' => $fromBranch->branch_id,
            'to_branch_id' => $toBranch->branch_id,
            'requested_by' => $requestedBy->staff_id,
            'requested_at' => $requestedAt,
            'approved_by' => $approvedBy->staff_id,
            'quantity' => $this->faker->numberBetween(1, 50),
            'transfer_date' => $transferDate,
            'transfer_status' => $this->faker->randomElement(['REQUESTED', 'IN_PROGRESS', 'COMPLETED', 'CANCELLED', 'REJECTED']),
            'transfer_note' => $this->faker->optional(0.7)->sentence(8),
        ];
    }
}

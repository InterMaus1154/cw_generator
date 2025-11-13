<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Branch;
use App\Models\Part;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BranchPart>
 */
class BranchPartFactory extends Factory
{
    public function definition(): array
    {
        $branch = Branch::inRandomOrder()->first();
        $part = Part::inRandomOrder()->first();

        return [
            'branch_id' => $branch ? $branch->branch_id : Branch::factory(),
            'part_id' => $part ? $part->part_id : Part::factory(),
            'quantity' => $this->faker->numberBetween(0, 200),
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Branch;
use App\Models\Staff;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BranchManager>
 */
class BranchManagerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $branch = Branch::inRandomOrder()->first();
        // Prefer staff from the same branch if available
        $staff = Staff::where('branch_id', $branch->branch_id)->inRandomOrder()->first() ?? Staff::inRandomOrder()->first();

        return [
            'branch_id' => $branch->branch_id,
            'staff_id' => $staff ? $staff->staff_id : Staff::factory(),
            'assigned_at' => $this->faker->dateTimeBetween('-5 years', 'now')->format('Y-m-d'),
            'is_active' => $this->faker->boolean(75),
        ];
    }
}

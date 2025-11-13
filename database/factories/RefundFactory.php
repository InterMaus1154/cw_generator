<?php

namespace Database\Factories;

use App\Models\Invoice;
use App\Models\Staff;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Refund>
 */
class RefundFactory extends Factory
{
    public function definition(): array
    {
        $invoice = Invoice::inRandomOrder()->first();
        $staff = Staff::inRandomOrder()->first();

        $inv_final = $invoice ? ($invoice->inv_final ?? 0) : $this->faker->randomFloat(2, 20, 500);
        $amount = $this->faker->randomFloat(2, 1, max(1, min(500, (float)$inv_final)));

        return [
            'inv_id' => $invoice ? $invoice->inv_id : Invoice::factory(),
            'refunded_by' => $staff ? $staff->staff_id : Staff::factory(),
            'refund_amount' => max(0.01, $amount),
            'refund_reason' => $this->faker->optional(0.5)->sentence(),
        ];
    }
}

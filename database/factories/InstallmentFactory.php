<?php

namespace Database\Factories;

use App\Models\Invoice;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Installment>
 */
class InstallmentFactory extends Factory
{
    public function definition(): array
    {
        $invoice = Invoice::inRandomOrder()->first();
        $num = $this->faker->numberBetween(1, 12);
        $due = $this->faker->dateTimeBetween('-1 years', '+1 years');
        $paid = $this->faker->optional(0.6)->dateTimeBetween($due, '+30 days');

        return [
            'inv_id' => $invoice ? $invoice->inv_id : Invoice::factory(),
            'inst_number' => $num,
            'inst_due_date' => $due->format('Y-m-d'),
            'inst_paid_date' => $paid ? $paid->format('Y-m-d') : null,
            'inst_status' => $paid ? 'PAID' : $this->faker->randomElement(['PENDING', 'OVERDUE', 'CANCELLED']),
        ];
    }
}

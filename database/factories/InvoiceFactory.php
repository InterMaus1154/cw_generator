<?php

namespace Database\Factories;

use App\Models\Booking;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $booking = Booking::inRandomOrder()->first();
        $issue = $this->faker->dateTimeBetween('-1 years', '+1 years');
        $due = (clone $issue)->modify('+'. $this->faker->numberBetween(7, 30) . ' days');

        $total = $this->faker->randomFloat(2, 20, 3000);
        $discount = $this->faker->optional(0.3)->randomFloat(2, 0, min(500, $total * 0.5)) ?? 0.00;
        $final = max(0.01, round($total - $discount, 2));

        return [
            'booking_id' => $booking ? $booking->booking_id : Booking::factory(),
            'inv_number' => 'INV-' . strtoupper($this->faker->regexify('[A-Z0-9]{12}')),
            'inv_issue_date' => $issue->format('Y-m-d'),
            'inv_due_date' => $due->format('Y-m-d'),
            'inv_total' => $total,
            'inv_discount' => $discount,
            'inv_final' => $final,
            // inv_status is a Postgres enum column added in migration; seeder may override
        ];
    }
}

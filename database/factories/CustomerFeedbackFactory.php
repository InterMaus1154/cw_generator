<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Booking;
use App\Models\Customer;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CustomerFeedback>
 */
class CustomerFeedbackFactory extends Factory
{
    public function definition(): array
    {
        $booking = Booking::inRandomOrder()->first();
        $customerId = $booking?->cust_id ?? Customer::inRandomOrder()->first()?->cust_id;

        return [
            'cust_id' => $customerId,
            'booking_id' => $booking ? $booking->booking_id : Booking::factory(),
            'cust_fb_content' => $this->faker->paragraph(2),
        ];
    }
}
}
 
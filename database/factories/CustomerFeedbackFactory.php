<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CustomerFeedback>
 */
class CustomerFeedbackFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cust_id' => Customer::all()->random()->cust_id,
            'cust_fb_content' => $this->faker->realTextBetween(100, 500)
        ];
    }
}

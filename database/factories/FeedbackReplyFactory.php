<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\CustomerFeedback;
use App\Models\Customer;
use App\Models\Staff;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FeedbackReply>
 */
class FeedbackReplyFactory extends Factory
{
    public function definition(): array
    {
        $fb = CustomerFeedback::inRandomOrder()->first();
        $byCustomer = random_int(0, 1) === 1;
        $cust = $byCustomer ? Customer::inRandomOrder()->first() : null;
        $staff = ! $byCustomer ? Staff::inRandomOrder()->first() : null;

        return [
            'cust_fb_id' => $fb ? $fb->cust_fb_id : CustomerFeedback::factory(),
            'staff_id' => $staff ? $staff->cust_id ?? $staff->staff_id : null,
            'cust_id' => $cust ? $cust->cust_id : null,
            'reply_to' => null,
            'reply_content' => $this->faker->sentence(12),
        ];
    }
}

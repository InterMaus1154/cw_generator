<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Membership;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Psy\Util\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // UK phone number formats
        $phoneFormats = [
            '07' . fake()->numerify('#########'), // Mobile: 07xxxxxxxxx
            '01' . fake()->numerify('#########'), // Landline: 01xxxxxxxxx
            '02' . fake()->numerify('#########'), // Landline: 02xxxxxxxxx
        ];

        // UK postcode format (simplified)
        $postcodeAreas = ['SW', 'SE', 'E', 'W', 'N', 'NW', 'EC', 'WC', 'M', 'B', 'L', 'LS', 'BD', 'GL'];
        $postcode = fake()->randomElement($postcodeAreas) . fake()->numberBetween(1, 99) . ' ' . fake()->randomLetter() . fake()->randomLetter() . fake()->randomLetter();

        return [
            'mship_id' => null, // Will be set in seeder for some customers
            'mship_start_date' => null,
            'mship_end_date' => null,
            'mship_auto_renew' => null,
            'cust_fname' => fake()->firstName(),
            'cust_lname' => fake()->lastName(),
            'cust_email' => fake()->unique()->safeEmail(),
            'cust_contact_num' => fake()->unique()->randomElement($phoneFormats),
            'cust_address_first' => fake()->streetAddress(),
            'cust_address_second' => fake()->optional(0.3)->secondaryAddress(),
            'cust_city' => City::inRandomOrder()->first()?->city_id ?? 1,
            'cust_postcode' => strtoupper($postcode),
        ];
    }

    /**
     * Indicate that the customer has an active membership.
     */
    public function withMembership(): static
    {
        return $this->state(function (array $attributes) {
            $membership = Membership::inRandomOrder()->first();

            if (!$membership) {
                return $attributes;
            }

            $startDate = Carbon::now()->subDays(rand(0, 180));
            $endDate = $startDate->copy()->addDays($membership->mship_duration_days);

            return [
                'mship_id' => $membership->mship_id,
                'mship_start_date' => $startDate->format('Y-m-d'),
                'mship_end_date' => $endDate->format('Y-m-d'),
                'mship_auto_renew' => fake()->boolean(75), // 75% auto-renew
            ];
        });
    }

    /**
     * Indicate that the customer has an expired membership.
     */
    public function withExpiredMembership(): static
    {
        return $this->state(function (array $attributes) {
            $membership = Membership::inRandomOrder()->first();

            if (!$membership) {
                return $attributes;
            }

            $endDate = Carbon::now()->subDays(rand(1, 90));
            $startDate = $endDate->copy()->subDays($membership->mship_duration_days);

            return [
                'mship_id' => $membership->mship_id,
                'mship_start_date' => $startDate->format('Y-m-d'),
                'mship_end_date' => $endDate->format('Y-m-d'),
                'mship_auto_renew' => fake()->boolean(30), // 30% would renew
            ];
        });
    }
}

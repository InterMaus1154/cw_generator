<?php

namespace Database\Factories;

use App\Models\Branch;
use App\Models\City;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Staff>
 */
class StaffFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $first = $this->faker->firstName;
        $last = $this->faker->lastName;
        $city = City::inRandomOrder()->first();

        return [
            'branch_id' => Branch::inRandomOrder()->first()->branch_id,
            'staff_code' => strtoupper($this->faker->unique()->regexify('[A-Z0-9]{11}')),
            'staff_fname' => $first,
            'staff_lname' => $last,
            'staff_email' => $this->faker->unique()->safeEmail,
            'staff_work_email' => $this->faker->unique()->companyEmail(),
            'staff_mobile' => $this->faker->unique()->e164PhoneNumber,
            'staff_work_phone' => $this->faker->optional(0.5)->e164PhoneNumber,
            'staff_address_first' => $this->faker->address,
            'staff_address_second' => $this->faker->optional(0.3)->secondaryAddress,
            'staff_city' => $city->city_id,
            'staff_postcode' => strtoupper($this->faker->regexify('[A-Z]{1,2}[0-9]{1,2} [0-9][A-Z]{2}')),
            'hired_at' => $this->faker->dateTimeBetween('-10 years', 'now')->format('Y-m-d')
        ];
    }
}

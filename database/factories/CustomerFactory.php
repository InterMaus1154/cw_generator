<?php

namespace Database\Factories;

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
        $midname = $this->faker->randomElement([0,1]) === 0 ? $this->faker->firstName : null;
        $secondAdd = $this->faker->randomElement([0,1]) === 0 ? $this->faker->streetAddress : null;
        return [
            'cust_firstname' => $this->faker->firstName,
            'cust_lastname' => $this->faker->lastName,
            'cust_midname' => $midname,
            'cust_email' => $this->faker->safeEmail,
            'cust_contact_number' => $this->faker->e164PhoneNumber(),
            'cust_address_first' => $this->faker->address,
            'cust_address_second' => $secondAdd,
            'cust_city' => $this->faker->city,
            'cust_postcode' => $this->faker->regexify('[A-Z]{1,2}[0-9]{1,2} [0-9][A-Z]{2}')
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
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
            'emp_firstname' => $this->faker->firstName,
            'emp_lastname' => $this->faker->lastName,
            'emp_midname' => $midname,
            'emp_email' => $this->faker->safeEmail,
            'emp_contact_number' => $this->faker->e164PhoneNumber,
            'emp_address_first' => $this->faker->address,
            'emp_address_second' => $secondAdd,
            'emp_city' => $this->faker->city,
            'emp_postcode' => $this->faker->regexify('[A-Z]{1,2}[0-9]{1,2} [0-9][A-Z]{2}')
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Supplier>
 */
class SupplierFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'sup_name' => $this->faker->company(), // e.g., "Hampshire Auto Parts Ltd"
            'sup_contact_name' => $this->faker->optional()->name(), // contact person
            'sup_contact_phone' => $this->faker->optional()->numerify('+44##########'), // UK-style mobile
            'sup_company_phone' => $this->faker->numerify('+44##########'),
            'sup_address_first' => $this->faker->streetAddress(),
            'sup_address_second' => $this->faker->optional()->streetAddress(),
            'sup_postcode' => strtoupper($this->faker->bothify('??## ???')), // UK postcode format
            'sup_city' => $this->faker->numberBetween(1, 10), // assuming 10 cities in 'cities' table
            'is_active' => $this->faker->boolean(90), // 90% active suppliers
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EmergencyContact>
 */
class EmergencyContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $type = fake()->randomElement(['LANDLINE', 'MOBILE', 'EMAIL']);

        $contact = match($type) {
            'LANDLINE' => '01' . fake()->numerify('#########'), // UK landline
            'MOBILE' => '07' . fake()->numerify('#########'),   // UK mobile
            'EMAIL' => fake()->safeEmail(),
        };

        return [
            'cust_id' => Customer::factory(),
            'emg_type' => $type,
            'emg_contact' => $contact,
        ];
    }

    /**
     * Landline emergency contact
     */
    public function landline(): static
    {
        return $this->state(fn (array $attributes) => [
            'emg_type' => 'LANDLINE',
            'emg_contact' => '01' . fake()->numerify('#########'),
        ]);
    }

    /**
     * Mobile emergency contact
     */
    public function mobile(): static
    {
        return $this->state(fn (array $attributes) => [
            'emg_type' => 'MOBILE',
            'emg_contact' => '07' . fake()->numerify('#########'),
        ]);
    }

    /**
     * Email emergency contact
     */
    public function email(): static
    {
        return $this->state(fn (array $attributes) => [
            'emg_type' => 'EMAIL',
            'emg_contact' => fake()->safeEmail(),
        ]);
    }
}

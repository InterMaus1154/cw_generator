<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\InventoryItem>
 */
class InventoryItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'inv_item_name' => $this->faker->word . ' ' . $this->faker->randomElement(['Gadget', 'Tool', 'Thing']),
            'inv_item_barcode' => Str::random(20),
            'inv_item_qty' => $this->faker->numberBetween(0, 50),
            'inv_item_price' => $this->faker->randomFloat(2, 10, 300)
        ];
    }
}

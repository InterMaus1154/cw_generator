<?php

namespace Database\Factories;

use App\Models\PartCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Part>
 */
class PartFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'part_cat_id' => $this->faker->randomElement(PartCategory::pluck('part_cat_id')->toArray()),
            'part_name' => sprintf('%s %s', $this->faker->word, $this->faker->randomElement(['Gadget', 'Tool', 'Thing', 'Item'])),
            'part_description' => $this->faker->optional()->text(maxNbChars: 100),
            'part_price' => $this->faker->randomFloat(2, 5, 300)
        ];
    }
}

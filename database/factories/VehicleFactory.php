<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 */
class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = (new \Faker\Factory())::create();
        $faker->addProvider(new \Faker\Provider\FakeCar($faker));

        return [
            'cust_id' => Customer::factory(),
            'vehicle_plate_number' => $faker->vehicleRegistration('[A-Z]{3}-[0-9]{3}'),
            'vehicle_brand' => $faker->vehicleBrand(),
            'vehicle_model' => $faker->vehicleModel(),
            'vehicle_color' => $faker->colorName,
            'vehicle_fuel_type' => $faker->randomElement(['diesel','petrol', 'hybrid', 'electric'])
        ];
    }
}

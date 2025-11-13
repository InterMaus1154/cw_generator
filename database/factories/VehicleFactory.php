<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\VehicleBrand;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 */
class VehicleFactory extends Factory
{
    private static $brandModels = [
        'Ford' => [
            ['model' => 'Fiesta', 'fuel' => ['PETROL', 'DIESEL']],
            ['model' => 'Focus', 'fuel' => ['PETROL', 'DIESEL', 'HYBRID']],
            ['model' => 'Mondeo', 'fuel' => ['PETROL', 'DIESEL', 'HYBRID']],
            ['model' => 'Kuga', 'fuel' => ['PETROL', 'DIESEL', 'HYBRID']],
            ['model' => 'Puma', 'fuel' => ['PETROL', 'HYBRID']],
            ['model' => 'Mustang Mach-E', 'fuel' => ['ELECTRIC']],
        ],
        'Volkswagen' => [
            ['model' => 'Golf', 'fuel' => ['PETROL', 'DIESEL', 'HYBRID', 'ELECTRIC']],
            ['model' => 'Polo', 'fuel' => ['PETROL', 'DIESEL']],
            ['model' => 'Passat', 'fuel' => ['PETROL', 'DIESEL', 'HYBRID']],
            ['model' => 'Tiguan', 'fuel' => ['PETROL', 'DIESEL', 'HYBRID']],
            ['model' => 'T-Roc', 'fuel' => ['PETROL', 'DIESEL']],
            ['model' => 'ID.3', 'fuel' => ['ELECTRIC']],
            ['model' => 'ID.4', 'fuel' => ['ELECTRIC']],
        ],
        'Vauxhall' => [
            ['model' => 'Corsa', 'fuel' => ['PETROL', 'DIESEL', 'ELECTRIC']],
            ['model' => 'Astra', 'fuel' => ['PETROL', 'DIESEL', 'HYBRID']],
            ['model' => 'Insignia', 'fuel' => ['PETROL', 'DIESEL']],
            ['model' => 'Mokka', 'fuel' => ['PETROL', 'DIESEL', 'ELECTRIC']],
            ['model' => 'Crossland', 'fuel' => ['PETROL', 'DIESEL']],
        ],
        'BMW' => [
            ['model' => '1 Series', 'fuel' => ['PETROL', 'DIESEL']],
            ['model' => '3 Series', 'fuel' => ['PETROL', 'DIESEL', 'HYBRID']],
            ['model' => '5 Series', 'fuel' => ['PETROL', 'DIESEL', 'HYBRID']],
            ['model' => 'X1', 'fuel' => ['PETROL', 'DIESEL']],
            ['model' => 'X3', 'fuel' => ['PETROL', 'DIESEL', 'HYBRID']],
            ['model' => 'X5', 'fuel' => ['PETROL', 'DIESEL', 'HYBRID']],
            ['model' => 'i3', 'fuel' => ['ELECTRIC']],
            ['model' => 'iX', 'fuel' => ['ELECTRIC']],
        ],
        'Audi' => [
            ['model' => 'A3', 'fuel' => ['PETROL', 'DIESEL', 'HYBRID']],
            ['model' => 'A4', 'fuel' => ['PETROL', 'DIESEL', 'HYBRID']],
            ['model' => 'A6', 'fuel' => ['PETROL', 'DIESEL', 'HYBRID']],
            ['model' => 'Q3', 'fuel' => ['PETROL', 'DIESEL']],
            ['model' => 'Q5', 'fuel' => ['PETROL', 'DIESEL', 'HYBRID']],
            ['model' => 'Q7', 'fuel' => ['PETROL', 'DIESEL', 'HYBRID']],
            ['model' => 'e-tron', 'fuel' => ['ELECTRIC']],
        ],
        'Mercedes-Benz' => [
            ['model' => 'A-Class', 'fuel' => ['PETROL', 'DIESEL']],
            ['model' => 'C-Class', 'fuel' => ['PETROL', 'DIESEL', 'HYBRID']],
            ['model' => 'E-Class', 'fuel' => ['PETROL', 'DIESEL', 'HYBRID']],
            ['model' => 'GLA', 'fuel' => ['PETROL', 'DIESEL']],
            ['model' => 'GLC', 'fuel' => ['PETROL', 'DIESEL', 'HYBRID']],
            ['model' => 'EQA', 'fuel' => ['ELECTRIC']],
            ['model' => 'EQC', 'fuel' => ['ELECTRIC']],
        ],
        'Toyota' => [
            ['model' => 'Yaris', 'fuel' => ['PETROL', 'HYBRID']],
            ['model' => 'Corolla', 'fuel' => ['PETROL', 'HYBRID']],
            ['model' => 'Camry', 'fuel' => ['HYBRID']],
            ['model' => 'RAV4', 'fuel' => ['PETROL', 'HYBRID']],
            ['model' => 'C-HR', 'fuel' => ['PETROL', 'HYBRID']],
            ['model' => 'Prius', 'fuel' => ['HYBRID']],
            ['model' => 'bZ4X', 'fuel' => ['ELECTRIC']],
        ],
        'Honda' => [
            ['model' => 'Civic', 'fuel' => ['PETROL', 'HYBRID']],
            ['model' => 'Jazz', 'fuel' => ['PETROL', 'HYBRID']],
            ['model' => 'CR-V', 'fuel' => ['PETROL', 'HYBRID']],
            ['model' => 'HR-V', 'fuel' => ['PETROL', 'HYBRID']],
            ['model' => 'e', 'fuel' => ['ELECTRIC']],
        ],
        'Nissan' => [
            ['model' => 'Micra', 'fuel' => ['PETROL']],
            ['model' => 'Juke', 'fuel' => ['PETROL', 'HYBRID']],
            ['model' => 'Qashqai', 'fuel' => ['PETROL', 'DIESEL', 'HYBRID']],
            ['model' => 'X-Trail', 'fuel' => ['PETROL', 'DIESEL', 'HYBRID']],
            ['model' => 'Leaf', 'fuel' => ['ELECTRIC']],
            ['model' => 'Ariya', 'fuel' => ['ELECTRIC']],
        ],
        'Hyundai' => [
            ['model' => 'i10', 'fuel' => ['PETROL']],
            ['model' => 'i20', 'fuel' => ['PETROL', 'HYBRID']],
            ['model' => 'i30', 'fuel' => ['PETROL', 'DIESEL']],
            ['model' => 'Tucson', 'fuel' => ['PETROL', 'DIESEL', 'HYBRID']],
            ['model' => 'Santa Fe', 'fuel' => ['PETROL', 'DIESEL', 'HYBRID']],
            ['model' => 'Kona Electric', 'fuel' => ['ELECTRIC']],
            ['model' => 'IONIQ 5', 'fuel' => ['ELECTRIC']],
        ],
        'Kia' => [
            ['model' => 'Picanto', 'fuel' => ['PETROL']],
            ['model' => 'Rio', 'fuel' => ['PETROL']],
            ['model' => 'Ceed', 'fuel' => ['PETROL', 'DIESEL']],
            ['model' => 'Sportage', 'fuel' => ['PETROL', 'DIESEL', 'HYBRID']],
            ['model' => 'Sorento', 'fuel' => ['PETROL', 'DIESEL', 'HYBRID']],
            ['model' => 'Niro', 'fuel' => ['HYBRID', 'ELECTRIC']],
            ['model' => 'EV6', 'fuel' => ['ELECTRIC']],
        ],
        'Peugeot' => [
            ['model' => '108', 'fuel' => ['PETROL']],
            ['model' => '208', 'fuel' => ['PETROL', 'DIESEL', 'ELECTRIC']],
            ['model' => '308', 'fuel' => ['PETROL', 'DIESEL', 'HYBRID']],
            ['model' => '2008', 'fuel' => ['PETROL', 'DIESEL', 'ELECTRIC']],
            ['model' => '3008', 'fuel' => ['PETROL', 'DIESEL', 'HYBRID']],
            ['model' => '5008', 'fuel' => ['PETROL', 'DIESEL']],
        ],
        'Renault' => [
            ['model' => 'Clio', 'fuel' => ['PETROL', 'DIESEL', 'HYBRID']],
            ['model' => 'Captur', 'fuel' => ['PETROL', 'DIESEL', 'HYBRID']],
            ['model' => 'Megane', 'fuel' => ['PETROL', 'DIESEL']],
            ['model' => 'Kadjar', 'fuel' => ['PETROL', 'DIESEL']],
            ['model' => 'Zoe', 'fuel' => ['ELECTRIC']],
            ['model' => 'Megane E-Tech', 'fuel' => ['ELECTRIC']],
        ],
        'Tesla' => [
            ['model' => 'Model 3', 'fuel' => ['ELECTRIC']],
            ['model' => 'Model Y', 'fuel' => ['ELECTRIC']],
            ['model' => 'Model S', 'fuel' => ['ELECTRIC']],
            ['model' => 'Model X', 'fuel' => ['ELECTRIC']],
        ],
        'Mazda' => [
            ['model' => 'Mazda2', 'fuel' => ['PETROL']],
            ['model' => 'Mazda3', 'fuel' => ['PETROL', 'HYBRID']],
            ['model' => 'CX-3', 'fuel' => ['PETROL']],
            ['model' => 'CX-5', 'fuel' => ['PETROL', 'DIESEL']],
            ['model' => 'CX-30', 'fuel' => ['PETROL', 'HYBRID']],
            ['model' => 'MX-30', 'fuel' => ['ELECTRIC']],
        ],
        'MINI' => [
            ['model' => 'Cooper', 'fuel' => ['PETROL']],
            ['model' => 'Clubman', 'fuel' => ['PETROL', 'DIESEL']],
            ['model' => 'Countryman', 'fuel' => ['PETROL', 'DIESEL', 'HYBRID']],
            ['model' => 'Electric', 'fuel' => ['ELECTRIC']],
        ],
        'Land Rover' => [
            ['model' => 'Discovery Sport', 'fuel' => ['PETROL', 'DIESEL', 'HYBRID']],
            ['model' => 'Range Rover Evoque', 'fuel' => ['PETROL', 'DIESEL', 'HYBRID']],
            ['model' => 'Discovery', 'fuel' => ['PETROL', 'DIESEL']],
            ['model' => 'Range Rover', 'fuel' => ['PETROL', 'DIESEL', 'HYBRID']],
            ['model' => 'Defender', 'fuel' => ['PETROL', 'DIESEL', 'HYBRID']],
        ],
    ];


    public function definition(): array
    {
        // UK registration format: AB12 CDE (2 letters, 2 numbers, 3 letters)
        $reg = strtoupper(fake()->lexify('??')) .
            fake()->numerify('##') .
            strtoupper(fake()->lexify('???'));

        // VIN: 17 character alphanumeric (no I, O, Q to avoid confusion)
        $vinChars = 'ABCDEFGHJKLMNPRSTUVWXYZ0123456789';
        $vin = '';
        for ($i = 0; $i < 17; $i++) {
            $vin .= $vinChars[rand(0, strlen($vinChars) - 1)];
        }

        $colours = ['Black', 'White', 'Silver', 'Grey', 'Blue', 'Red', 'Green', 'Yellow', 'Orange', 'Brown'];

        // Year between 2010 and 2024
        $year = fake()->numberBetween(2010, 2024);

        // Get a random brand that exists in our mappings
        $availableBrands = array_keys(self::$brandModels);
        $randomBrandName = fake()->randomElement($availableBrands);

        // Find the brand in database
        $brand = VehicleBrand::where('vec_brand_name', $randomBrandName)->first();

        // If brand not found, get any brand
        if (!$brand) {
            $brand = VehicleBrand::inRandomOrder()->first();
            $brandName = $brand->vec_brand_name ?? 'Ford';
        } else {
            $brandName = $randomBrandName;
        }

        // Get models for this brand
        $models = self::$brandModels[$brandName] ?? self::$brandModels['Ford'];
        $selectedModel = fake()->randomElement($models);

        return [
            'vec_brand_id' => $brand->vec_brand_id ?? 1,
            'cust_id' => Customer::factory(),
            'vec_model' => $selectedModel['model'],
            'vec_reg' => $reg,
            'vec_year' => $year,
            'vec_colour' => fake()->randomElement($colours),
            'vec_vin' => $vin,
            'vec_fuel_type' => fake()->randomElement($selectedModel['fuel']),
        ];
    }
}

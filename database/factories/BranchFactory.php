<?php

namespace Database\Factories;

use App\Models\City;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Branch>
 */
class BranchFactory extends Factory
{

    private array $branchNames = ['General Service', 'MOT Test Centre', 'Body Repair Shop', 'Wheel Centre', 'Diagnostics Centre', 'Electric Service', 'Performance Tuning Centre'];

    public function definition(): array
    {
        $postcodeAreas = ['SW', 'SE', 'E', 'W', 'N', 'NW', 'EC', 'WC', 'M', 'B', 'L', 'LS', 'BD', 'GL'];
        $postcode = fake()->randomElement($postcodeAreas) . fake()->numberBetween(1, 99) . ' ' . fake()->randomLetter() . fake()->randomLetter() . fake()->randomLetter();

        $city = City::inRandomOrder()->first();
        $branchName = fake()->randomElement($this->branchNames);
        $words = explode(' ', $branchName);
        $firstTwo = array_slice($words, 0, 2);
        $branchNameShort = strtoupper(sprintf('%s%s', $firstTwo[0][0], $firstTwo[1][0]));
        $branchRandomNumber = fake()->randomNumber(nbDigits: 2);
        $branchCode = strtoupper(sprintf('%s%s%s%d', $city->city_name[0], $city->city_name[1], $branchNameShort, $branchRandomNumber));
        return [
            'branch_code' => $branchCode,
            'branch_name' => sprintf('%s %s %d', $city->city_name, $branchName, $branchRandomNumber),
            'branch_phone' => sprintf('02%s', fake()->numerify('#########')),
            'branch_email' => fake()->companyEmail(),
            'branch_address_first' => fake()->streetAddress(),
            'branch_address_second' => fake()->optional(0.3)->secondaryAddress(),
            'branch_postcode' => strtoupper($postcode),
            'branch_city' => $city->city_id
        ];
    }
}

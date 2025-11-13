<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Vehicle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $vehiclesCreated = 0;

        foreach (Customer::all() as $customer) {
            // Distribution: 90% have 1 car, 10% have 2 cars
            $numberOfVehicles = (rand(1, 100) <= 90) ? 1 : 2;

            for ($i = 0; $i < $numberOfVehicles; $i++) {
                Vehicle::factory()->create([
                    'cust_id' => $customer->cust_id,
                ]);

                $vehiclesCreated++;
            }
        }
    }
}

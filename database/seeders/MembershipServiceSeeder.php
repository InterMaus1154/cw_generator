<?php

namespace Database\Seeders;

use App\Models\Membership;
use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MembershipServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $memberships = Membership::all();
        $services = Service::all();


        $membershipServices = [];
        $existingCombinations = [];

        // Define service benefits for each membership
        $membershipBenefits = [
            'Weekly Express' => [
                ['service' => 'Standard Oil Change', 'type' => 'PERCENT', 'value' => 100.00], // Free
                ['service' => 'Tire Pressure Check', 'type' => 'PERCENT', 'value' => 100.00], // Free
                ['service' => 'Multi-Point Inspection', 'type' => 'PERCENT', 'value' => 50.00], // 50% off
            ],
            'Basic Care' => [
                ['service' => 'Standard Oil Change', 'type' => 'PERCENT', 'value' => 100.00], // Free (1 per month)
                ['service' => 'Tire Rotation', 'type' => 'PERCENT', 'value' => 100.00], // Free
                ['service' => 'Multi-Point Inspection', 'type' => 'PERCENT', 'value' => 100.00], // Free
                ['service' => 'Brake System Inspection', 'type' => 'PERCENT', 'value' => 10.00], // 10% off
                ['service' => 'Battery Testing', 'type' => 'PERCENT', 'value' => 10.00], // 10% off
            ],
            'Premium Plus' => [
                ['service' => 'Synthetic Oil Change', 'type' => 'PERCENT', 'value' => 100.00], // Free
                ['service' => 'Tire Rotation', 'type' => 'PERCENT', 'value' => 100.00], // Free
                ['service' => 'Brake System Inspection', 'type' => 'PERCENT', 'value' => 100.00], // Free
                ['service' => 'Battery Testing', 'type' => 'PERCENT', 'value' => 100.00], // Free
                ['service' => 'Multi-Point Inspection', 'type' => 'PERCENT', 'value' => 100.00], // Free
                ['service' => 'Air Filter Replacement', 'type' => 'PERCENT', 'value' => 15.00], // 15% off
                ['service' => 'Cabin Air Filter Replacement', 'type' => 'PERCENT', 'value' => 15.00], // 15% off
                ['service' => 'Wiper Blade Replacement', 'type' => 'PERCENT', 'value' => 15.00], // 15% off
            ],
            'Fleet Manager' => [
                ['service' => 'Standard Oil Change', 'type' => 'PERCENT', 'value' => 100.00], // Free
                ['service' => 'Tire Rotation', 'type' => 'PERCENT', 'value' => 100.00], // Free
                ['service' => 'Multi-Point Inspection', 'type' => 'PERCENT', 'value' => 100.00], // Free
                ['service' => 'Front Brake Pad Replacement', 'type' => 'PERCENT', 'value' => 20.00], // 20% off
                ['service' => 'Rear Brake Pad Replacement', 'type' => 'PERCENT', 'value' => 20.00], // 20% off
                ['service' => 'Battery Replacement', 'type' => 'PERCENT', 'value' => 20.00], // 20% off
                ['service' => 'Tire Balance - Per Tire', 'type' => 'FIXED', 'value' => 5.00], // £5 off
            ],
            'Luxury Elite' => [
                ['service' => 'Synthetic Oil Change', 'type' => 'PERCENT', 'value' => 100.00], // Free
                ['service' => 'Multi-Point Inspection', 'type' => 'PERCENT', 'value' => 100.00], // Free
                ['service' => 'Tire Rotation', 'type' => 'PERCENT', 'value' => 100.00], // Free
                ['service' => 'Wheel Alignment - 4 Wheel', 'type' => 'PERCENT', 'value' => 25.00], // 25% off
                ['service' => 'Brake System Inspection', 'type' => 'PERCENT', 'value' => 100.00], // Free
                ['service' => 'Engine Tune-Up', 'type' => 'PERCENT', 'value' => 25.00], // 25% off
                ['service' => 'Spark Plug Replacement', 'type' => 'FIXED', 'value' => 50.00], // £50 off
            ],
            'Annual Saver' => [
                ['service' => 'Standard Oil Change', 'type' => 'PERCENT', 'value' => 100.00], // Free (4x/year)
                ['service' => 'Tire Rotation', 'type' => 'PERCENT', 'value' => 100.00], // Free (4x/year)
                ['service' => 'Multi-Point Inspection', 'type' => 'PERCENT', 'value' => 100.00], // Free (2x/year)
                ['service' => 'Battery Testing', 'type' => 'PERCENT', 'value' => 100.00], // Free
                ['service' => 'Brake System Inspection', 'type' => 'PERCENT', 'value' => 12.00], // 12% off
                ['service' => 'Air Filter Replacement', 'type' => 'PERCENT', 'value' => 12.00], // 12% off
            ],
            'Ultimate Protection' => [
                ['service' => 'Synthetic Oil Change', 'type' => 'PERCENT', 'value' => 100.00], // Unlimited free
                ['service' => 'Tire Rotation', 'type' => 'PERCENT', 'value' => 100.00], // Unlimited free
                ['service' => 'Brake System Inspection', 'type' => 'PERCENT', 'value' => 100.00], // Free
                ['service' => 'Multi-Point Inspection', 'type' => 'PERCENT', 'value' => 100.00], // Free
                ['service' => 'Front Brake Pad Replacement', 'type' => 'PERCENT', 'value' => 20.00], // 20% off
                ['service' => 'Rear Brake Pad Replacement', 'type' => 'PERCENT', 'value' => 20.00], // 20% off
                ['service' => 'Battery Replacement', 'type' => 'PERCENT', 'value' => 20.00], // 20% off
                ['service' => 'Alternator Replacement', 'type' => 'FIXED', 'value' => 100.00], // £100 off
                ['service' => 'Starter Replacement', 'type' => 'FIXED', 'value' => 75.00], // £75 off
            ],
            'Commercial Fleet Annual' => [
                ['service' => 'Standard Oil Change', 'type' => 'PERCENT', 'value' => 100.00], // Free
                ['service' => 'Tire Rotation', 'type' => 'PERCENT', 'value' => 100.00], // Free
                ['service' => 'Multi-Point Inspection', 'type' => 'PERCENT', 'value' => 100.00], // Free
                ['service' => 'State Safety Inspection', 'type' => 'PERCENT', 'value' => 100.00], // Free
                ['service' => 'Front Brake Pad Replacement', 'type' => 'PERCENT', 'value' => 25.00], // 25% off
                ['service' => 'Rear Brake Pad Replacement', 'type' => 'PERCENT', 'value' => 25.00], // 25% off
                ['service' => 'Battery Replacement', 'type' => 'PERCENT', 'value' => 25.00], // 25% off
                ['service' => 'Tire Installation - Per Tire', 'type' => 'FIXED', 'value' => 10.00], // £10 off per tire
            ],
            'Enthusiast Annual' => [
                ['service' => 'Synthetic Oil Change', 'type' => 'PERCENT', 'value' => 100.00], // Unlimited free
                ['service' => 'Engine Tune-Up', 'type' => 'PERCENT', 'value' => 100.00], // Free seasonal
                ['service' => 'Multi-Point Inspection', 'type' => 'PERCENT', 'value' => 100.00], // Free
                ['service' => 'Spark Plug Replacement', 'type' => 'PERCENT', 'value' => 30.00], // 30% off
                ['service' => 'Throttle Body Cleaning', 'type' => 'PERCENT', 'value' => 30.00], // 30% off
                ['service' => 'Fuel Injection Cleaning', 'type' => 'PERCENT', 'value' => 30.00], // 30% off
                ['service' => 'Wheel Alignment - 4 Wheel', 'type' => 'FIXED', 'value' => 40.00], // £40 off
                ['service' => 'Timing Belt Replacement', 'type' => 'FIXED', 'value' => 150.00], // £150 off
            ],
            'High Mileage Annual' => [
                ['service' => 'High Mileage Oil Change', 'type' => 'PERCENT', 'value' => 100.00], // Free (6x/year)
                ['service' => 'Tire Rotation', 'type' => 'PERCENT', 'value' => 100.00], // Free (6x/year)
                ['service' => 'Multi-Point Inspection', 'type' => 'PERCENT', 'value' => 100.00], // Free
                ['service' => 'Throttle Body Cleaning', 'type' => 'PERCENT', 'value' => 100.00], // Free
                ['service' => 'Front Brake Pad Replacement', 'type' => 'PERCENT', 'value' => 15.00], // 15% off
                ['service' => 'Rear Brake Pad Replacement', 'type' => 'PERCENT', 'value' => 15.00], // 15% off
                ['service' => 'Tire Installation - Per Tire', 'type' => 'PERCENT', 'value' => 15.00], // 15% off
            ],
        ];

        foreach ($membershipBenefits as $membershipName => $benefits) {
            $membership = $memberships->firstWhere('mship_name', $membershipName);

            if (!$membership) continue;

            foreach ($benefits as $benefit) {
                $service = $services->firstWhere('service_name', $benefit['service']);

                if (!$service) continue;

                $key = $membership->mship_id . '-' . $service->service_id;

                if (!isset($existingCombinations[$key])) {
                    $existingCombinations[$key] = true;

                    $membershipServices[] = [
                        'mship_id' => $membership->mship_id,
                        'service_id' => $service->service_id,
                        'discount_type' => $benefit['type'],
                        'discount_value' => $benefit['value'],
                    ];
                }
            }
        }

        DB::table('membership_services')->insert($membershipServices);
    }
}

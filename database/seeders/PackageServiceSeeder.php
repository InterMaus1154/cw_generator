<?php

namespace Database\Seeders;

use App\Models\Package;
use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PackageServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $packages = Package::all();
        $services = Service::all();

        $packageServices = [];
        $existingCombinations = [];

        // Define service categories for realistic package assignments
        $serviceCategories = [
            'Basic Maintenance Package' => [
                'Standard Oil Change',
                'Tire Rotation',
                'Brake System Inspection',
                'Multi-Point Inspection',
                'Air Filter Replacement',
                'Tire Pressure Check',
            ],
            'Premium Care Package' => [
                'Synthetic Oil Change',
                'Tire Rotation',
                'Wheel Alignment - 4 Wheel',
                'Brake System Inspection',
                'Battery Testing',
                'Multi-Point Inspection',
                'Air Filter Replacement',
                'Cabin Air Filter Replacement',
                'Wiper Blade Replacement',
            ],
            'Winter Ready Package' => [
                'Coolant Flush',
                'Battery Testing',
                'Battery Replacement',
                'Tire Pressure Check',
                'Wiper Blade Replacement',
                'Thermostat Replacement',
            ],
            'Summer Safety Package' => [
                'A/C Recharge',
                'Coolant Flush',
                'Tire Rotation',
                'Battery Testing',
                'Brake System Inspection',
            ],
            'Pre-Purchase Inspection Package' => [
                'Pre-Purchase Inspection',
                'Computer Diagnostic Scan',
                'Check Engine Light Diagnostic',
                'Brake System Inspection',
                'Battery Testing',
                'Multi-Point Inspection',
            ],
            'Fleet Maintenance Package' => [
                'Standard Oil Change',
                'Tire Rotation',
                'Brake System Inspection',
                'Multi-Point Inspection',
                'Battery Testing',
            ],
            'Express Service Package' => [
                'Standard Oil Change',
                'Tire Pressure Check',
                'Multi-Point Inspection',
            ],
            'Luxury Vehicle Care Package' => [
                'Synthetic Oil Change',
                'Tire Rotation',
                'Wheel Alignment - 4 Wheel',
                'Multi-Point Inspection',
                'Air Filter Replacement',
                'Cabin Air Filter Replacement',
            ],
            'Brake and Safety Package' => [
                'Front Brake Pad Replacement',
                'Rear Brake Pad Replacement',
                'Brake Fluid Flush',
                'Brake System Inspection',
                'Tire Rotation',
                'Headlight Bulb Replacement',
            ],
            'Engine Performance Package' => [
                'Spark Plug Replacement',
                'Fuel Injection Cleaning',
                'Throttle Body Cleaning',
                'Air Filter Replacement',
                'Engine Tune-Up',
                'PCV Valve Replacement',
            ],
        ];

        foreach ($packages as $package) {
            $packageName = $package->pkg_name;

            // Get predefined services for this package if they exist
            if (isset($serviceCategories[$packageName])) {
                $serviceNames = $serviceCategories[$packageName];

                foreach ($serviceNames as $serviceName) {
                    $service = $services->firstWhere('service_name', $serviceName);

                    if ($service) {
                        $key = $package->pkg_id . '-' . $service->service_id;

                        if (!isset($existingCombinations[$key])) {
                            $existingCombinations[$key] = true;

                            $packageServices[] = [
                                'pkg_id' => $package->pkg_id,
                                'service_id' => $service->service_id,
                            ];
                        }
                    }
                }
            } else {
                // Fallback: assign random services if package not in predefined list
                $numberOfServices = rand(3, 8);
                $randomServices = $services->random(min($numberOfServices, $services->count()));

                foreach ($randomServices as $service) {
                    $key = $package->pkg_id . '-' . $service->service_id;

                    if (!isset($existingCombinations[$key])) {
                        $existingCombinations[$key] = true;

                        $packageServices[] = [
                            'pkg_id' => $package->pkg_id,
                            'service_id' => $service->service_id,
                        ];
                    }
                }
            }
        }

        // Bulk insert
        DB::table('package_services')->insert($packageServices);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceDiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = Service::all();

        $discounts = [];
        $currentDate = Carbon::now();

        // Seasonal promotions
        $seasonalPromotions = [
            [
                'name' => 'Winter Maintenance Sale',
                'services' => ['Battery Replacement', 'Battery Testing', 'Coolant Flush', 'Thermostat Replacement', 'Wiper Blade Replacement'],
                'disc_amount' => 15.00,
                'disc_from' => $currentDate->copy()->month(11)->day(1), // November
                'disc_to' => $currentDate->copy()->month(12)->day(31),  // December
                'is_active' => true,
            ],
            [
                'name' => 'Spring Tune-Up Special',
                'services' => ['Engine Tune-Up', 'Spark Plug Replacement', 'Air Filter Replacement', 'Cabin Air Filter Replacement'],
                'disc_amount' => 20.00,
                'disc_from' => $currentDate->copy()->month(3)->day(1),  // March
                'disc_to' => $currentDate->copy()->month(4)->day(30),   // April
                'is_active' => false,
            ],
            [
                'name' => 'Summer Road Trip Ready',
                'services' => ['A/C Recharge', 'Tire Rotation', 'Wheel Alignment - 4 Wheel', 'Coolant Flush'],
                'disc_amount' => 25.00,
                'disc_from' => $currentDate->copy()->month(6)->day(1),  // June
                'disc_to' => $currentDate->copy()->month(7)->day(31),   // July
                'is_active' => false,
            ],
            [
                'name' => 'Back to School Oil Change',
                'services' => ['Standard Oil Change', 'Synthetic Oil Change', 'High Mileage Oil Change'],
                'disc_amount' => 10.00,
                'disc_from' => $currentDate->copy()->month(8)->day(15), // Mid August
                'disc_to' => $currentDate->copy()->month(9)->day(15),   // Mid September
                'is_active' => false,
            ],
        ];

        // Add seasonal promotions
        foreach ($seasonalPromotions as $promo) {
            foreach ($promo['services'] as $serviceName) {
                $service = $services->firstWhere('service_name', $serviceName);

                if ($service) {
                    $discounts[] = [
                        'service_id' => $service->service_id,
                        'disc_amount' => $promo['disc_amount'],
                        'disc_from' => $promo['disc_from']->format('Y-m-d'),
                        'disc_to' => $promo['disc_to']->format('Y-m-d'),
                        'is_active' => $promo['is_active'],
                    ];
                }
            }
        }

        // Random ongoing discounts (20-30 services with active discounts)
        $randomServices = $services->random(min(25, $services->count()));

        foreach ($randomServices as $service) {
            // Skip if service already has a discount
            if (collect($discounts)->where('service_id', $service->service_id)->isNotEmpty()) {
                continue;
            }

            $startDate = $currentDate->copy()->subDays(rand(0, 30));
            $endDate = $startDate->copy()->addDays(rand(30, 90));

            $discounts[] = [
                'service_id' => $service->service_id,
                'disc_amount' => fake()->randomFloat(2, 5.00, 50.00),
                'disc_from' => $startDate->format('Y-m-d'),
                'disc_to' => $endDate->format('Y-m-d'),
                'is_active' => fake()->boolean(70), // 70% active
            ];
        }

        // Expired discounts (historical data)
        $expiredServices = $services->random(min(15, $services->count()));

        foreach ($expiredServices as $service) {
            // Skip if service already has a discount
            if (collect($discounts)->where('service_id', $service->service_id)->isNotEmpty()) {
                continue;
            }

            $endDate = $currentDate->copy()->subDays(rand(1, 60));
            $startDate = $endDate->copy()->subDays(rand(30, 60));

            $discounts[] = [
                'service_id' => $service->service_id,
                'disc_amount' => fake()->randomFloat(2, 10.00, 40.00),
                'disc_from' => $startDate->format('Y-m-d'),
                'disc_to' => $endDate->format('Y-m-d'),
                'is_active' => false,
            ];
        }

        // Future planned discounts
        $futureServices = $services->random(min(10, $services->count()));

        foreach ($futureServices as $service) {
            // Skip if service already has a discount
            if (collect($discounts)->where('service_id', $service->service_id)->isNotEmpty()) {
                continue;
            }

            $startDate = $currentDate->copy()->addDays(rand(10, 60));
            $endDate = $startDate->copy()->addDays(rand(30, 90));

            $discounts[] = [
                'service_id' => $service->service_id,
                'disc_amount' => fake()->randomFloat(2, 15.00, 45.00),
                'disc_from' => $startDate->format('Y-m-d'),
                'disc_to' => $endDate->format('Y-m-d'),
                'is_active' => true,
            ];
        }

        // Bulk insert
        DB::table('service_discounts')->insert($discounts);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MembershipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $memberships = [
            // Weekly Memberships
            [
                'mship_name' => 'Weekly Express',
                'mship_description' => 'Perfect for frequent drivers who need regular maintenance. Includes 1 express oil change per week, free tire pressure checks, and priority scheduling. Save time with our quick 30-minute service guarantee.',
                'mship_price' => 39.99,
                'mship_duration_days' => 7,
                'mship_pay_period' => 'WEEKLY',
            ],

            // Monthly Memberships
            [
                'mship_name' => 'Basic Care',
                'mship_description' => 'Essential monthly maintenance for budget-conscious drivers. Includes 1 standard oil change, tire rotation, multi-point inspection, and 10% off all additional services. Great value for regular vehicle upkeep.',
                'mship_price' => 49.99,
                'mship_duration_days' => 30,
                'mship_pay_period' => 'MONTHLY',
            ],
            [
                'mship_name' => 'Premium Plus',
                'mship_description' => 'Comprehensive monthly care package for vehicle enthusiasts. Includes 1 synthetic oil change, tire rotation, brake inspection, battery test, fluid top-offs, and 15% off all services and parts. Priority appointment booking available.',
                'mship_price' => 89.99,
                'mship_duration_days' => 30,
                'mship_pay_period' => 'MONTHLY',
            ],
            [
                'mship_name' => 'Fleet Manager',
                'mship_description' => 'Designed for business owners with multiple vehicles. Covers up to 3 vehicles with monthly oil changes, tire services, inspections, and 20% discount on repairs. Includes fleet management reporting and dedicated service advisor.',
                'mship_price' => 199.99,
                'mship_duration_days' => 30,
                'mship_pay_period' => 'MONTHLY',
            ],
            [
                'mship_name' => 'Luxury Elite',
                'mship_description' => 'White-glove service for luxury and high-performance vehicles. Monthly synthetic oil service with premium filters, detailed inspection following manufacturer specs, complimentary car wash, and 25% off all genuine parts and specialized services.',
                'mship_price' => 149.99,
                'mship_duration_days' => 30,
                'mship_pay_period' => 'MONTHLY',
            ],

            // Yearly Memberships
            [
                'mship_name' => 'Annual Saver',
                'mship_description' => 'Best value for the full year! Includes 4 oil changes, 4 tire rotations, 2 multi-point inspections, battery testing, and 12% off all services. Save over $200 compared to monthly payments. Perfect for average mileage drivers.',
                'mship_price' => 499.99,
                'mship_duration_days' => 365,
                'mship_pay_period' => 'YEARLY',
            ],
            [
                'mship_name' => 'Ultimate Protection',
                'mship_description' => 'Complete annual coverage for worry-free driving. Includes unlimited oil changes, quarterly tire rotations, brake inspections, seasonal multi-point inspections, 20% off all repairs, roadside assistance, and free loaner vehicle for major services.',
                'mship_price' => 999.99,
                'mship_duration_days' => 365,
                'mship_pay_period' => 'YEARLY',
            ],
            [
                'mship_name' => 'Commercial Fleet Annual',
                'mship_description' => 'Comprehensive yearly plan for business fleets. Covers up to 5 vehicles with scheduled maintenance, priority emergency service, detailed maintenance logs for tax purposes, 25% parts discount, and dedicated account manager. Includes DOT inspection assistance.',
                'mship_price' => 1999.99,
                'mship_duration_days' => 365,
                'mship_pay_period' => 'YEARLY',
            ],
            [
                'mship_name' => 'Enthusiast Annual',
                'mship_description' => 'For car lovers who want the best for their vehicles year-round. Unlimited synthetic oil changes, performance inspections, seasonal tune-ups, premium parts discount (30% off), exclusive events access, and concierge scheduling service.',
                'mship_price' => 1499.99,
                'mship_duration_days' => 365,
                'mship_pay_period' => 'YEARLY',
            ],
            [
                'mship_name' => 'High Mileage Annual',
                'mship_description' => 'Tailored for drivers covering 20,000+ miles annually. Includes 6 oil changes with high-mileage oil, 6 tire rotations, extended inspections, engine cleaning services, 15% discount on wear items (brakes, tires), and mileage tracking assistance.',
                'mship_price' => 749.99,
                'mship_duration_days' => 365,
                'mship_pay_period' => 'YEARLY',
            ],
        ];

        DB::table('memberships')->insert($memberships);
    }
}

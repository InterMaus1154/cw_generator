<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $packages = [
            [
                'pkg_name' => 'Basic Maintenance Package',
                'pkg_desc' => 'Essential maintenance services including oil changes, tire rotation, brake inspection, and fluid top-ups. Perfect for keeping your vehicle running smoothly with regular care.',
                'is_active' => true,
            ],
            [
                'pkg_name' => 'Premium Care Package',
                'pkg_desc' => 'Comprehensive service package including full vehicle inspection, oil and filter change, brake service, tire rotation and balancing, battery test, and multi-point inspection. Ideal for maximum vehicle longevity.',
                'is_active' => true,
            ],
            [
                'pkg_name' => 'Winter Ready Package',
                'pkg_desc' => 'Prepare your vehicle for cold weather with antifreeze check and replacement, battery testing, tire pressure adjustment, heating system inspection, and windshield washer fluid refill.',
                'is_active' => true,
            ],
            [
                'pkg_name' => 'Summer Safety Package',
                'pkg_desc' => 'Get ready for summer driving with air conditioning service, coolant system check, tire inspection and rotation, battery testing, and brake system evaluation.',
                'is_active' => true,
            ],
            [
                'pkg_name' => 'Pre-Purchase Inspection Package',
                'pkg_desc' => 'Comprehensive 150-point inspection for used car buyers. Includes engine diagnostics, transmission check, suspension evaluation, body and frame inspection, and detailed report of findings.',
                'is_active' => true,
            ],
            [
                'pkg_name' => 'Fleet Maintenance Package',
                'pkg_desc' => 'Designed for business vehicles requiring regular upkeep. Bulk service rates for oil changes, tire services, brake inspections, and scheduled maintenance across multiple vehicles.',
                'is_active' => false,
            ],
            [
                'pkg_name' => 'Express Service Package',
                'pkg_desc' => 'Quick turnaround package for busy professionals. Includes express oil change, tire pressure check, fluid level inspection, and basic safety check completed in under 30 minutes.',
                'is_active' => true,
            ],
            [
                'pkg_name' => 'Luxury Vehicle Care Package',
                'pkg_desc' => 'Specialized service for high-end and luxury vehicles. Premium synthetic oil, detailed inspection using manufacturer specifications, genuine parts replacement, and white-glove service experience.',
                'is_active' => true,
            ],
            [
                'pkg_name' => 'Brake and Safety Package',
                'pkg_desc' => 'Focus on critical safety systems including complete brake inspection, pad and rotor service, brake fluid replacement, tire tread depth check, and lighting system inspection.',
                'is_active' => true,
            ],
            [
                'pkg_name' => 'Engine Performance Package',
                'pkg_desc' => 'Optimize your engine performance with spark plug replacement, fuel system cleaning, air filter replacement, engine diagnostic scan, and throttle body service for improved fuel efficiency and power.',
                'is_active' => false, // One inactive for variety
            ],
        ];

        DB::table('packages')->insert($packages);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PartCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('part_categories')->insert([
            ['part_cat_id' => 1, 'part_cat_name' => 'Braking System'],
            ['part_cat_id' => 2, 'part_cat_name' => 'Suspension'],
            ['part_cat_id' => 3, 'part_cat_name' => 'Steering'],
            ['part_cat_id' => 4, 'part_cat_name' => 'Transmission'],
            ['part_cat_id' => 5, 'part_cat_name' => 'Engine Components'],
            ['part_cat_id' => 6, 'part_cat_name' => 'Cooling System'],
            ['part_cat_id' => 7, 'part_cat_name' => 'Exhaust System'],
            ['part_cat_id' => 8, 'part_cat_name' => 'Electrical System'],
            ['part_cat_id' => 9, 'part_cat_name' => 'Lighting'],
            ['part_cat_id' => 10, 'part_cat_name' => 'Fuel System'],
            ['part_cat_id' => 11, 'part_cat_name' => 'Air Intake'],
            ['part_cat_id' => 12, 'part_cat_name' => 'Interior Accessories'],
            ['part_cat_id' => 13, 'part_cat_name' => 'Exterior Accessories'],
            ['part_cat_id' => 14, 'part_cat_name' => 'Tyres & Wheels'],
            ['part_cat_id' => 15, 'part_cat_name' => 'Body Panels'],
            ['part_cat_id' => 16, 'part_cat_name' => 'Sensors'],
            ['part_cat_id' => 17, 'part_cat_name' => 'Ignition System'],
            ['part_cat_id' => 18, 'part_cat_name' => 'Belts & Chains'],
            ['part_cat_id' => 19, 'part_cat_name' => 'Bearings'],
            ['part_cat_id' => 20, 'part_cat_name' => 'Seals & Gaskets'],
            ['part_cat_id' => 21, 'part_cat_name' => 'Heating & Ventilation'],
            ['part_cat_id' => 22, 'part_cat_name' => 'Air Conditioning'],
            ['part_cat_id' => 23, 'part_cat_name' => 'Lubricants & Fluids'],
            ['part_cat_id' => 24, 'part_cat_name' => 'Clutch Components'],
            ['part_cat_id' => 25, 'part_cat_name' => 'Drivetrain'],
            ['part_cat_id' => 26, 'part_cat_name' => 'Filters'],
            ['part_cat_id' => 27, 'part_cat_name' => 'Fuses & Relays'],
            ['part_cat_id' => 28, 'part_cat_name' => 'Mirrors'],
            ['part_cat_id' => 29, 'part_cat_name' => 'Wipers & Washers'],
            ['part_cat_id' => 30, 'part_cat_name' => 'Fasteners & Clips'],
        ]);
    }
}

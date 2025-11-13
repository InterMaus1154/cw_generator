<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VehicleBrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            // Popular British & European
            ['vec_brand_name' => 'Audi'],
            ['vec_brand_name' => 'BMW'],
            ['vec_brand_name' => 'Mercedes-Benz'],
            ['vec_brand_name' => 'Volkswagen'],
            ['vec_brand_name' => 'Vauxhall'],
            ['vec_brand_name' => 'Ford'],
            ['vec_brand_name' => 'Peugeot'],
            ['vec_brand_name' => 'Renault'],
            ['vec_brand_name' => 'Citroën'],
            ['vec_brand_name' => 'Volvo'],
            ['vec_brand_name' => 'MINI'],
            ['vec_brand_name' => 'Land Rover'],
            ['vec_brand_name' => 'Jaguar'],
            ['vec_brand_name' => 'Porsche'],
            ['vec_brand_name' => 'Fiat'],
            ['vec_brand_name' => 'Alfa Romeo'],
            ['vec_brand_name' => 'SEAT'],
            ['vec_brand_name' => 'Skoda'],
            ['vec_brand_name' => 'Dacia'],

            // Japanese
            ['vec_brand_name' => 'Toyota'],
            ['vec_brand_name' => 'Honda'],
            ['vec_brand_name' => 'Nissan'],
            ['vec_brand_name' => 'Mazda'],
            ['vec_brand_name' => 'Suzuki'],
            ['vec_brand_name' => 'Subaru'],
            ['vec_brand_name' => 'Mitsubishi'],
            ['vec_brand_name' => 'Lexus'],
            ['vec_brand_name' => 'Infiniti'],
            ['vec_brand_name' => 'Acura'],
            ['vec_brand_name' => 'Isuzu'],
            ['vec_brand_name' => 'Daihatsu'],

            // Korean
            ['vec_brand_name' => 'Hyundai'],
            ['vec_brand_name' => 'Kia'],
            ['vec_brand_name' => 'Genesis'],
            ['vec_brand_name' => 'SsangYong'],

            // American
            ['vec_brand_name' => 'Chevrolet'],
            ['vec_brand_name' => 'Jeep'],
            ['vec_brand_name' => 'Dodge'],
            ['vec_brand_name' => 'Chrysler'],
            ['vec_brand_name' => 'Cadillac'],
            ['vec_brand_name' => 'Tesla'],
            ['vec_brand_name' => 'Buick'],
            ['vec_brand_name' => 'GMC'],
            ['vec_brand_name' => 'Lincoln'],
            ['vec_brand_name' => 'RAM'],

            // Luxury & Sports
            ['vec_brand_name' => 'Bentley'],
            ['vec_brand_name' => 'Rolls-Royce'],
            ['vec_brand_name' => 'Aston Martin'],
            ['vec_brand_name' => 'Ferrari'],
            ['vec_brand_name' => 'Lamborghini'],
            ['vec_brand_name' => 'Maserati'],
            ['vec_brand_name' => 'McLaren'],
            ['vec_brand_name' => 'Bugatti'],
            ['vec_brand_name' => 'Lotus'],

            // Other European
            ['vec_brand_name' => 'Smart'],
            ['vec_brand_name' => 'Opel'],
            ['vec_brand_name' => 'Lancia'],
            ['vec_brand_name' => 'Saab'],
            ['vec_brand_name' => 'DS Automobiles'],

            // Chinese & Emerging
            ['vec_brand_name' => 'MG'],
            ['vec_brand_name' => 'BYD'],
            ['vec_brand_name' => 'Geely'],
            ['vec_brand_name' => 'Great Wall'],
            ['vec_brand_name' => 'Chery'],
            ['vec_brand_name' => 'Lynk & Co'],
            ['vec_brand_name' => 'Polestar'],
        ];

        DB::table('vehicle_brands')->insert($brands);
    }
}

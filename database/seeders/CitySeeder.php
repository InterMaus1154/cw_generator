<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cities')->insert([
            ['city_name' => 'Portsmouth'],
            ['city_name' => 'Southampton'],
            ['city_name' => 'Havant'],
            ['city_name' => 'Fareham'],
            ['city_name' => 'Gosport'],
            ['city_name' => 'Winchester'],
            ['city_name' => 'Eastleigh'],
            ['city_name' => 'Waterlooville'],
            ['city_name' => 'Petersfield'],
            ['city_name' => 'Aldershot']
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            // Oil & Fluids
            ['service_name' => 'Standard Oil Change', 'service_desc' => 'Conventional oil change with up to 5 quarts of oil and new oil filter', 'service_price' => 39.99],
            ['service_name' => 'Synthetic Oil Change', 'service_desc' => 'Premium synthetic oil change with up to 5 quarts and new oil filter', 'service_price' => 74.99],
            ['service_name' => 'High Mileage Oil Change', 'service_desc' => 'Specialized oil for vehicles over 75,000 miles', 'service_price' => 64.99],
            ['service_name' => 'Transmission Fluid Service', 'service_desc' => 'Drain and refill transmission fluid with filter replacement', 'service_price' => 189.99],
            ['service_name' => 'Coolant Flush', 'service_desc' => 'Complete coolant system flush and refill with new antifreeze', 'service_price' => 119.99],
            ['service_name' => 'Brake Fluid Flush', 'service_desc' => 'Complete brake fluid system flush and replacement', 'service_price' => 99.99],
            ['service_name' => 'Power Steering Fluid Service', 'service_desc' => 'Power steering fluid flush and replacement', 'service_price' => 84.99],
            ['service_name' => 'Differential Fluid Change', 'service_desc' => 'Replace differential fluid for optimal performance', 'service_price' => 114.99],

            // Brakes
            ['service_name' => 'Front Brake Pad Replacement', 'service_desc' => 'Replace front brake pads with premium quality parts', 'service_price' => 224.99],
            ['service_name' => 'Rear Brake Pad Replacement', 'service_desc' => 'Replace rear brake pads with premium quality parts', 'service_price' => 224.99],
            ['service_name' => 'Front Brake Rotor Replacement', 'service_desc' => 'Machine or replace front brake rotors', 'service_price' => 299.99],
            ['service_name' => 'Rear Brake Rotor Replacement', 'service_desc' => 'Machine or replace rear brake rotors', 'service_price' => 299.99],
            ['service_name' => 'Brake Caliper Replacement', 'service_desc' => 'Replace faulty brake caliper, per wheel', 'service_price' => 349.99],
            ['service_name' => 'Brake Line Replacement', 'service_desc' => 'Replace damaged or corroded brake lines', 'service_price' => 274.99],
            ['service_name' => 'Parking Brake Adjustment', 'service_desc' => 'Adjust and test parking brake system', 'service_price' => 69.99],
            ['service_name' => 'Brake System Inspection', 'service_desc' => 'Comprehensive brake system inspection and report', 'service_price' => 39.99],

            // Tires
            ['service_name' => 'Tire Rotation', 'service_desc' => 'Rotate all four tires for even wear', 'service_price' => 34.99],
            ['service_name' => 'Wheel Alignment - 2 Wheel', 'service_desc' => 'Front-end alignment service', 'service_price' => 84.99],
            ['service_name' => 'Wheel Alignment - 4 Wheel', 'service_desc' => 'Complete four-wheel alignment service', 'service_price' => 124.99],
            ['service_name' => 'Tire Balance - Per Tire', 'service_desc' => 'Balance individual tire and wheel assembly', 'service_price' => 22.99],
            ['service_name' => 'Tire Installation - Per Tire', 'service_desc' => 'Mount and balance new tire', 'service_price' => 35.99],
            ['service_name' => 'Tire Repair - Patch', 'service_desc' => 'Patch punctured tire from inside', 'service_price' => 27.99],
            ['service_name' => 'Tire Pressure Check', 'service_desc' => 'Check and adjust all tire pressures', 'service_price' => 0.00],
            ['service_name' => 'TPMS Sensor Replacement', 'service_desc' => 'Replace tire pressure monitoring sensor', 'service_price' => 99.99],

            // Battery & Electrical
            ['service_name' => 'Battery Replacement', 'service_desc' => 'Install new battery with warranty', 'service_price' => 184.99],
            ['service_name' => 'Battery Testing', 'service_desc' => 'Test battery health and charging system', 'service_price' => 0.00],
            ['service_name' => 'Alternator Replacement', 'service_desc' => 'Replace faulty alternator', 'service_price' => 499.99],
            ['service_name' => 'Starter Replacement', 'service_desc' => 'Replace faulty starter motor', 'service_price' => 424.99],
            ['service_name' => 'Headlight Bulb Replacement', 'service_desc' => 'Replace headlight bulb (per bulb)', 'service_price' => 54.99],
            ['service_name' => 'Tail Light Bulb Replacement', 'service_desc' => 'Replace tail light bulb (per bulb)', 'service_price' => 19.99],
            ['service_name' => 'Wiper Blade Replacement', 'service_desc' => 'Replace windshield wiper blades (pair)', 'service_price' => 36.99],
            ['service_name' => 'Fuse Replacement', 'service_desc' => 'Diagnose and replace blown fuse', 'service_price' => 34.99],

            // Engine
            ['service_name' => 'Spark Plug Replacement', 'service_desc' => 'Replace all spark plugs', 'service_price' => 169.99],
            ['service_name' => 'Air Filter Replacement', 'service_desc' => 'Replace engine air filter', 'service_price' => 41.99],
            ['service_name' => 'Cabin Air Filter Replacement', 'service_desc' => 'Replace cabin air filter', 'service_price' => 49.99],
            ['service_name' => 'Fuel Filter Replacement', 'service_desc' => 'Replace fuel filter', 'service_price' => 84.99],
            ['service_name' => 'Timing Belt Replacement', 'service_desc' => 'Replace timing belt and tensioners', 'service_price' => 749.99],
            ['service_name' => 'Serpentine Belt Replacement', 'service_desc' => 'Replace serpentine/drive belt', 'service_price' => 114.99],
            ['service_name' => 'Throttle Body Cleaning', 'service_desc' => 'Clean throttle body and intake system', 'service_price' => 119.99],
            ['service_name' => 'Fuel Injection Cleaning', 'service_desc' => 'Clean fuel injectors and system', 'service_price' => 139.99],
            ['service_name' => 'Engine Tune-Up', 'service_desc' => 'Complete engine tune-up service', 'service_price' => 299.99],
            ['service_name' => 'PCV Valve Replacement', 'service_desc' => 'Replace positive crankcase ventilation valve', 'service_price' => 59.99],

            // Suspension & Steering
            ['service_name' => 'Shock Absorber Replacement - Front', 'service_desc' => 'Replace front shock absorbers (pair)', 'service_price' => 449.99],
            ['service_name' => 'Shock Absorber Replacement - Rear', 'service_desc' => 'Replace rear shock absorbers (pair)', 'service_price' => 449.99],
            ['service_name' => 'Strut Replacement - Front', 'service_desc' => 'Replace front struts (pair)', 'service_price' => 599.99],
            ['service_name' => 'Strut Replacement - Rear', 'service_desc' => 'Replace rear struts (pair)', 'service_price' => 599.99],
            ['service_name' => 'Control Arm Replacement', 'service_desc' => 'Replace control arm and bushings', 'service_price' => 374.99],
            ['service_name' => 'Ball Joint Replacement', 'service_desc' => 'Replace worn ball joint', 'service_price' => 249.99],
            ['service_name' => 'Tie Rod End Replacement', 'service_desc' => 'Replace tie rod end', 'service_price' => 189.99],
            ['service_name' => 'Sway Bar Link Replacement', 'service_desc' => 'Replace sway bar links', 'service_price' => 149.99],
            ['service_name' => 'Wheel Bearing Replacement', 'service_desc' => 'Replace wheel bearing assembly', 'service_price' => 324.99],
            ['service_name' => 'Power Steering Pump Replacement', 'service_desc' => 'Replace power steering pump', 'service_price' => 524.99],

            // Exhaust
            ['service_name' => 'Muffler Replacement', 'service_desc' => 'Replace muffler assembly', 'service_price' => 349.99],
            ['service_name' => 'Catalytic Converter Replacement', 'service_desc' => 'Replace catalytic converter', 'service_price' => 1049.99],
            ['service_name' => 'Exhaust Pipe Repair', 'service_desc' => 'Repair or replace exhaust pipe section', 'service_price' => 274.99],
            ['service_name' => 'Oxygen Sensor Replacement', 'service_desc' => 'Replace oxygen sensor', 'service_price' => 224.99],

            // Climate Control
            ['service_name' => 'A/C Recharge', 'service_desc' => 'Recharge air conditioning system with refrigerant', 'service_price' => 119.99],
            ['service_name' => 'A/C Compressor Replacement', 'service_desc' => 'Replace A/C compressor', 'service_price' => 899.99],
            ['service_name' => 'A/C Condenser Replacement', 'service_desc' => 'Replace A/C condenser', 'service_price' => 599.99],
            ['service_name' => 'Heater Core Replacement', 'service_desc' => 'Replace heater core', 'service_price' => 749.99],
            ['service_name' => 'Blower Motor Replacement', 'service_desc' => 'Replace HVAC blower motor', 'service_price' => 299.99],
            ['service_name' => 'Thermostat Replacement', 'service_desc' => 'Replace engine thermostat', 'service_price' => 134.99],

            // Diagnostic & Inspection
            ['service_name' => 'Check Engine Light Diagnostic', 'service_desc' => 'Scan and diagnose check engine light codes', 'service_price' => 74.99],
            ['service_name' => 'Multi-Point Inspection', 'service_desc' => 'Comprehensive vehicle inspection', 'service_price' => 0.00],
            ['service_name' => 'Pre-Purchase Inspection', 'service_desc' => 'Detailed inspection for used car buyers', 'service_price' => 224.99],
            ['service_name' => 'State Safety Inspection', 'service_desc' => 'Official state safety inspection', 'service_price' => 34.99],
            ['service_name' => 'Emissions Test', 'service_desc' => 'Emissions testing and certification', 'service_price' => 44.99],
            ['service_name' => 'Computer Diagnostic Scan', 'service_desc' => 'Full vehicle computer system scan', 'service_price' => 119.99],

            // Transmission
            ['service_name' => 'Transmission Repair', 'service_desc' => 'Transmission rebuild or major repair', 'service_price' => 2749.99],
            ['service_name' => 'Clutch Replacement', 'service_desc' => 'Replace clutch assembly (manual transmission)', 'service_price' => 1199.99],
            ['service_name' => 'CV Axle Replacement', 'service_desc' => 'Replace CV axle shaft', 'service_price' => 324.99],
            ['service_name' => 'Transfer Case Service', 'service_desc' => 'Service transfer case fluid (4WD/AWD)', 'service_price' => 139.99],

            // Cooling System
            ['service_name' => 'Radiator Replacement', 'service_desc' => 'Replace radiator assembly', 'service_price' => 599.99],
            ['service_name' => 'Water Pump Replacement', 'service_desc' => 'Replace water pump', 'service_price' => 499.99],
            ['service_name' => 'Radiator Hose Replacement', 'service_desc' => 'Replace radiator hoses', 'service_price' => 114.99],
            ['service_name' => 'Cooling Fan Replacement', 'service_desc' => 'Replace cooling fan assembly', 'service_price' => 374.99],

            // Body & Glass
            ['service_name' => 'Windshield Replacement', 'service_desc' => 'Replace windshield glass', 'service_price' => 349.99],
            ['service_name' => 'Windshield Chip Repair', 'service_desc' => 'Repair small windshield chip or crack', 'service_price' => 74.99],
            ['service_name' => 'Door Lock Actuator Replacement', 'service_desc' => 'Replace door lock actuator', 'service_price' => 224.99],
            ['service_name' => 'Window Regulator Replacement', 'service_desc' => 'Replace power window regulator', 'service_price' => 299.99],

            // Fuel System
            ['service_name' => 'Fuel Pump Replacement', 'service_desc' => 'Replace fuel pump assembly', 'service_price' => 649.99],
            ['service_name' => 'Fuel Tank Replacement', 'service_desc' => 'Replace fuel tank', 'service_price' => 899.99],
            ['service_name' => 'Evap System Repair', 'service_desc' => 'Repair evaporative emission system', 'service_price' => 399.99],

            // Miscellaneous
            ['service_name' => 'Engine Mount Replacement', 'service_desc' => 'Replace engine mount', 'service_price' => 324.99],
            ['service_name' => 'Horn Replacement', 'service_desc' => 'Replace horn assembly', 'service_price' => 94.99],
            ['service_name' => 'Seat Belt Replacement', 'service_desc' => 'Replace seat belt assembly', 'service_price' => 224.99],
            ['service_name' => 'Mirror Replacement', 'service_desc' => 'Replace side mirror assembly', 'service_price' => 274.99],
            ['service_name' => 'Key Fob Programming', 'service_desc' => 'Program new key fob', 'service_price' => 144.99],
            ['service_name' => 'Oil Leak Repair', 'service_desc' => 'Diagnose and repair oil leak', 'service_price' => 474.99],
            ['service_name' => 'Gasket Replacement', 'service_desc' => 'Replace various engine gaskets', 'service_price' => 599.99],
            ['service_name' => 'Wheel Stud Replacement', 'service_desc' => 'Replace broken wheel stud', 'service_price' => 74.99],
            ['service_name' => 'MOT Test', 'service_desc' => 'MOT Test', 'service_price' => 60.00]
        ];

        DB::table('services')->insert($services);
    }
}

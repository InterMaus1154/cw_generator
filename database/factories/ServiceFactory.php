<?php

namespace Database\Factories;

use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $services = [
            // Oil & Fluids
            ['name' => 'Standard Oil Change', 'desc' => 'Conventional oil change with up to 5 quarts of oil and new oil filter', 'price' => [29.99, 49.99]],
            ['name' => 'Synthetic Oil Change', 'desc' => 'Premium synthetic oil change with up to 5 quarts and new oil filter', 'price' => [59.99, 89.99]],
            ['name' => 'High Mileage Oil Change', 'desc' => 'Specialized oil for vehicles over 75,000 miles', 'price' => [54.99, 79.99]],
            ['name' => 'Transmission Fluid Service', 'desc' => 'Drain and refill transmission fluid with filter replacement', 'price' => [129.99, 249.99]],
            ['name' => 'Coolant Flush', 'desc' => 'Complete coolant system flush and refill with new antifreeze', 'price' => [89.99, 149.99]],
            ['name' => 'Brake Fluid Flush', 'desc' => 'Complete brake fluid system flush and replacement', 'price' => [79.99, 119.99]],
            ['name' => 'Power Steering Fluid Service', 'desc' => 'Power steering fluid flush and replacement', 'price' => [69.99, 99.99]],
            ['name' => 'Differential Fluid Change', 'desc' => 'Replace differential fluid for optimal performance', 'price' => [89.99, 139.99]],

            // Brakes
            ['name' => 'Front Brake Pad Replacement', 'desc' => 'Replace front brake pads with premium quality parts', 'price' => [149.99, 299.99]],
            ['name' => 'Rear Brake Pad Replacement', 'desc' => 'Replace rear brake pads with premium quality parts', 'price' => [149.99, 299.99]],
            ['name' => 'Front Brake Rotor Replacement', 'desc' => 'Machine or replace front brake rotors', 'price' => [199.99, 399.99]],
            ['name' => 'Rear Brake Rotor Replacement', 'desc' => 'Machine or replace rear brake rotors', 'price' => [199.99, 399.99]],
            ['name' => 'Brake Caliper Replacement', 'desc' => 'Replace faulty brake caliper, per wheel', 'price' => [249.99, 449.99]],
            ['name' => 'Brake Line Replacement', 'desc' => 'Replace damaged or corroded brake lines', 'price' => [149.99, 399.99]],
            ['name' => 'Parking Brake Adjustment', 'desc' => 'Adjust and test parking brake system', 'price' => [49.99, 89.99]],
            ['name' => 'Brake System Inspection', 'desc' => 'Comprehensive brake system inspection and report', 'price' => [29.99, 49.99]],

            // Tires
            ['name' => 'Tire Rotation', 'desc' => 'Rotate all four tires for even wear', 'price' => [24.99, 49.99]],
            ['name' => 'Wheel Alignment - 2 Wheel', 'desc' => 'Front-end alignment service', 'price' => [69.99, 99.99]],
            ['name' => 'Wheel Alignment - 4 Wheel', 'desc' => 'Complete four-wheel alignment service', 'price' => [99.99, 149.99]],
            ['name' => 'Tire Balance - Per Tire', 'desc' => 'Balance individual tire and wheel assembly', 'price' => [15.99, 29.99]],
            ['name' => 'Tire Installation - Per Tire', 'desc' => 'Mount and balance new tire', 'price' => [25.99, 45.99]],
            ['name' => 'Tire Repair - Patch', 'desc' => 'Patch punctured tire from inside', 'price' => [19.99, 35.99]],
            ['name' => 'Tire Pressure Check', 'desc' => 'Check and adjust all tire pressures', 'price' => [0.00, 9.99]],
            ['name' => 'TPMS Sensor Replacement', 'desc' => 'Replace tire pressure monitoring sensor', 'price' => [69.99, 129.99]],

            // Battery & Electrical
            ['name' => 'Battery Replacement', 'desc' => 'Install new battery with warranty', 'price' => [119.99, 249.99]],
            ['name' => 'Battery Testing', 'desc' => 'Test battery health and charging system', 'price' => [0.00, 19.99]],
            ['name' => 'Alternator Replacement', 'desc' => 'Replace faulty alternator', 'price' => [299.99, 699.99]],
            ['name' => 'Starter Replacement', 'desc' => 'Replace faulty starter motor', 'price' => [249.99, 599.99]],
            ['name' => 'Headlight Bulb Replacement', 'desc' => 'Replace headlight bulb (per bulb)', 'price' => [19.99, 89.99]],
            ['name' => 'Tail Light Bulb Replacement', 'desc' => 'Replace tail light bulb (per bulb)', 'price' => [9.99, 29.99]],
            ['name' => 'Wiper Blade Replacement', 'desc' => 'Replace windshield wiper blades (pair)', 'price' => [24.99, 49.99]],
            ['name' => 'Fuse Replacement', 'desc' => 'Diagnose and replace blown fuse', 'price' => [19.99, 49.99]],

            // Engine
            ['name' => 'Spark Plug Replacement', 'desc' => 'Replace all spark plugs', 'price' => [89.99, 249.99]],
            ['name' => 'Air Filter Replacement', 'desc' => 'Replace engine air filter', 'price' => [24.99, 59.99]],
            ['name' => 'Cabin Air Filter Replacement', 'desc' => 'Replace cabin air filter', 'price' => [29.99, 69.99]],
            ['name' => 'Fuel Filter Replacement', 'desc' => 'Replace fuel filter', 'price' => [49.99, 119.99]],
            ['name' => 'Timing Belt Replacement', 'desc' => 'Replace timing belt and tensioners', 'price' => [499.99, 999.99]],
            ['name' => 'Serpentine Belt Replacement', 'desc' => 'Replace serpentine/drive belt', 'price' => [79.99, 149.99]],
            ['name' => 'Throttle Body Cleaning', 'desc' => 'Clean throttle body and intake system', 'price' => [89.99, 149.99]],
            ['name' => 'Fuel Injection Cleaning', 'desc' => 'Clean fuel injectors and system', 'price' => [99.99, 179.99]],
            ['name' => 'Engine Tune-Up', 'desc' => 'Complete engine tune-up service', 'price' => [199.99, 399.99]],
            ['name' => 'PCV Valve Replacement', 'desc' => 'Replace positive crankcase ventilation valve', 'price' => [39.99, 79.99]],

            // Suspension & Steering
            ['name' => 'Shock Absorber Replacement - Front', 'desc' => 'Replace front shock absorbers (pair)', 'price' => [299.99, 599.99]],
            ['name' => 'Shock Absorber Replacement - Rear', 'desc' => 'Replace rear shock absorbers (pair)', 'price' => [299.99, 599.99]],
            ['name' => 'Strut Replacement - Front', 'desc' => 'Replace front struts (pair)', 'price' => [399.99, 799.99]],
            ['name' => 'Strut Replacement - Rear', 'desc' => 'Replace rear struts (pair)', 'price' => [399.99, 799.99]],
            ['name' => 'Control Arm Replacement', 'desc' => 'Replace control arm and bushings', 'price' => [249.99, 499.99]],
            ['name' => 'Ball Joint Replacement', 'desc' => 'Replace worn ball joint', 'price' => [149.99, 349.99]],
            ['name' => 'Tie Rod End Replacement', 'desc' => 'Replace tie rod end', 'price' => [129.99, 249.99]],
            ['name' => 'Sway Bar Link Replacement', 'desc' => 'Replace sway bar links', 'price' => [99.99, 199.99]],
            ['name' => 'Wheel Bearing Replacement', 'desc' => 'Replace wheel bearing assembly', 'price' => [199.99, 449.99]],
            ['name' => 'Power Steering Pump Replacement', 'desc' => 'Replace power steering pump', 'price' => [349.99, 699.99]],

            // Exhaust
            ['name' => 'Muffler Replacement', 'desc' => 'Replace muffler assembly', 'price' => [199.99, 499.99]],
            ['name' => 'Catalytic Converter Replacement', 'desc' => 'Replace catalytic converter', 'price' => [599.99, 1499.99]],
            ['name' => 'Exhaust Pipe Repair', 'desc' => 'Repair or replace exhaust pipe section', 'price' => [149.99, 399.99]],
            ['name' => 'Oxygen Sensor Replacement', 'desc' => 'Replace oxygen sensor', 'price' => [149.99, 299.99]],

            // Climate Control
            ['name' => 'A/C Recharge', 'desc' => 'Recharge air conditioning system with refrigerant', 'price' => [89.99, 149.99]],
            ['name' => 'A/C Compressor Replacement', 'desc' => 'Replace A/C compressor', 'price' => [599.99, 1199.99]],
            ['name' => 'A/C Condenser Replacement', 'desc' => 'Replace A/C condenser', 'price' => [399.99, 799.99]],
            ['name' => 'Heater Core Replacement', 'desc' => 'Replace heater core', 'price' => [499.99, 999.99]],
            ['name' => 'Blower Motor Replacement', 'desc' => 'Replace HVAC blower motor', 'price' => [199.99, 399.99]],
            ['name' => 'Thermostat Replacement', 'desc' => 'Replace engine thermostat', 'price' => [89.99, 179.99]],

            // Diagnostic & Inspection
            ['name' => 'Check Engine Light Diagnostic', 'desc' => 'Scan and diagnose check engine light codes', 'price' => [49.99, 99.99]],
            ['name' => 'Multi-Point Inspection', 'desc' => 'Comprehensive vehicle inspection', 'price' => [29.99, 0.00]],
            ['name' => 'Pre-Purchase Inspection', 'desc' => 'Detailed inspection for used car buyers', 'price' => [149.99, 299.99]],
            ['name' => 'State Safety Inspection', 'desc' => 'Official state safety inspection', 'price' => [19.99, 49.99]],
            ['name' => 'Emissions Test', 'desc' => 'Emissions testing and certification', 'price' => [29.99, 59.99]],
            ['name' => 'Computer Diagnostic Scan', 'desc' => 'Full vehicle computer system scan', 'price' => [89.99, 149.99]],

            // Transmission
            ['name' => 'Transmission Repair', 'desc' => 'Transmission rebuild or major repair', 'price' => [1499.99, 3999.99]],
            ['name' => 'Clutch Replacement', 'desc' => 'Replace clutch assembly (manual transmission)', 'price' => [799.99, 1599.99]],
            ['name' => 'CV Axle Replacement', 'desc' => 'Replace CV axle shaft', 'price' => [199.99, 449.99]],
            ['name' => 'Transfer Case Service', 'desc' => 'Service transfer case fluid (4WD/AWD)', 'price' => [99.99, 179.99]],

            // Cooling System
            ['name' => 'Radiator Replacement', 'desc' => 'Replace radiator assembly', 'price' => [399.99, 799.99]],
            ['name' => 'Water Pump Replacement', 'desc' => 'Replace water pump', 'price' => [299.99, 699.99]],
            ['name' => 'Radiator Hose Replacement', 'desc' => 'Replace radiator hoses', 'price' => [79.99, 149.99]],
            ['name' => 'Cooling Fan Replacement', 'desc' => 'Replace cooling fan assembly', 'price' => [249.99, 499.99]],

            // Body & Glass
            ['name' => 'Windshield Replacement', 'desc' => 'Replace windshield glass', 'price' => [199.99, 499.99]],
            ['name' => 'Windshield Chip Repair', 'desc' => 'Repair small windshield chip or crack', 'price' => [49.99, 99.99]],
            ['name' => 'Door Lock Actuator Replacement', 'desc' => 'Replace door lock actuator', 'price' => [149.99, 299.99]],
            ['name' => 'Window Regulator Replacement', 'desc' => 'Replace power window regulator', 'price' => [199.99, 399.99]],

            // Fuel System
            ['name' => 'Fuel Pump Replacement', 'desc' => 'Replace fuel pump assembly', 'price' => [399.99, 899.99]],
            ['name' => 'Fuel Tank Replacement', 'desc' => 'Replace fuel tank', 'price' => [599.99, 1199.99]],
            ['name' => 'Evap System Repair', 'desc' => 'Repair evaporative emission system', 'price' => [199.99, 599.99]],

            // Miscellaneous
            ['name' => 'Engine Mount Replacement', 'desc' => 'Replace engine mount', 'price' => [199.99, 449.99]],
            ['name' => 'Horn Replacement', 'desc' => 'Replace horn assembly', 'price' => [59.99, 129.99]],
            ['name' => 'Seat Belt Replacement', 'desc' => 'Replace seat belt assembly', 'price' => [149.99, 299.99]],
            ['name' => 'Mirror Replacement', 'desc' => 'Replace side mirror assembly', 'price' => [149.99, 399.99]],
            ['name' => 'Key Fob Programming', 'desc' => 'Program new key fob', 'price' => [89.99, 199.99]],
            ['name' => 'Oil Leak Repair', 'desc' => 'Diagnose and repair oil leak', 'price' => [149.99, 799.99]],
            ['name' => 'Gasket Replacement', 'desc' => 'Replace various engine gaskets', 'price' => [199.99, 999.99]],
            ['name' => 'Wheel Stud Replacement', 'desc' => 'Replace broken wheel stud', 'price' => [49.99, 99.99]],
        ];

        $service = fake()->randomElement($services);

        return [
            'service_name' => $service['name'],
            'service_desc' => $service['desc'],
            'service_price' => fake()->randomFloat(2, $service['price'][0], $service['price'][1]),
        ];
    }
}

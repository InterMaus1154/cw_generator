<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Department;
use App\Models\Employee;
use App\Models\EmployeeSchedule;
use App\Models\Role;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Vehicle;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Customer::factory(100)->has(Vehicle::factory()->count(random_int(1, 3)))->create();

        DB::statement("INSERT INTO departments(dept_name, dept_type)
VALUES
('Engine & Transmission', 'Primary'),
('Electrical Systems', 'Primary'),
('Bodywork & Painting', 'Primary'),
('General Maintenance', 'Primary'),
('Customer Service', 'Operational'),
('Finance', 'Operational');");

        DB::statement("INSERT INTO roles(role_name)
VALUES
('Painter'),
('Electric Technician'),
('Human Resources'),
('Tire Technician'),
('Department Manager'),
('Transmission Technician'),
('Receptionist'),
('Inventory Manager'),
('Accountant'),
('Service Advisor'),
('Performance Tuning'),
('Engine Technician'),
('Sound Systems Technician'),
('Cleaning Technician'),
('Oil & Lube Technician'),
('Polishing Technician');");

        $deps = Department::all();
        $employees = Employee::factory()->has(EmployeeSchedule::factory(5))->count(50)->create();
        $roles = Role::all();
        foreach ($employees as $employee) {
            DB::table('employee_roles')->insert([
                'emp_id' => $employee->emp_id,
                'role_id' => $roles->random()->role_id,
                'dept_id' => $deps->random()->dept_id
            ]);
        }

        $services = [
            'Car Painting',
            'Oil Replacement',
            'Tire Check',
            'Brake Inspection',
            'Battery Replacement',
            'Engine Diagnostics',
            'Wheel Alignment',
            'Air Filter Change',
            'AC Maintenance',
            'Transmission Repair',
            'Suspension Check',
            'Exhaust System Repair',
            'Radiator Flush',
            'Fuel System Cleaning',
            'Headlight Restoration',
            'Windshield Replacement',
            'Car Detailing',
            'Car Waxing',
            'Interior Cleaning',
            'Spark Plug Replacement',
            'Timing Belt Change',
            'Steering System Repair',
            'Alternator Replacement',
            'Starter Motor Repair',
            'Wiper Blade Replacement',
            'Emissions Testing',
            'Engine Oil Leak Fix',
            'Power Steering Fluid Change',
            'Tire Rotation',
            'Car Horn Repair',
            'Coolant Replacement',
            'Dashboard Electronics Fix',
            'Remote Key Programming',
            'Catalytic Converter Replacement',
            'Clutch Repair',
            'Door Lock Repair',
            'Paint Scratch Removal',
            'Underbody Rust Protection',
            'Seat Belt Repair',
            'Car Audio System Installation',
            'Sunroof Repair',
            'Turbocharger Repair',
            'Parking Sensor Installation',
            'Fuel Injector Cleaning',
            'Cabin Air Filter Replacement',
            'Engine Mount Replacement',
            'Differential Fluid Change',
            'Car Wrap Installation',
            'TPMS (Tire Pressure Monitoring System) Repair',
            'Hybrid Battery Service',
        ];

        foreach ($services as $service) {
            DB::table('services')
                ->insert([
                    'dept_id' => $deps->random()->dept_id,
                    'service_name' => $service,
                    'service_price' => Factory::create()->randomFloat(2, 20, 999)
                ]);
        }

    }
}

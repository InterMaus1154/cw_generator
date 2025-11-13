<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            'Painter',
            'Electric Technician',
            'Human Resources',
            'Finance',
            'Receptionist',
            'Tire Technician',
            'Department Manager',
            'Branch Manager',
            'Transmission Technician',
            'Inventory Manager',
            'Accountant',
            'Service Advisor',
            'Performance Tuning',
            'Engine Technician',
            'Sound Systems Technician',
            'Cleaning Technician',
            'Oil & Lube Technician',
            'Polishing Technician',
            'Diagnostics Specialist',
            'AC Technician',
            'Brake Specialist',
            'Tyre Fitter',
            'Paint Prep Technician',
            'Detailing Technician',
            'Parts Coordinator'
        ];

        foreach ($roles as $role) {
            \DB::table('roles')->insertOrIgnore([
                'role_name' => $role
            ]);
        }
    }
}

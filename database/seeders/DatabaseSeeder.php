<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Customer;
use App\Models\CustomerFeedback;
use App\Models\Department;
use App\Models\Employee;
use App\Models\EmployeeSchedule;
use App\Models\InventoryItem;
use App\Models\Role;
use App\Models\Service;
use App\Models\Supplier;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Vehicle;
use Database\Factories\CustomerFeedbackFactory;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    /*public function run(): void
    {

        $employees = Employee::factory()->has(EmployeeSchedule::factory(5))->count(35)->create();

        Customer::factory(25)->create()->each(function ($customer) use ($employees) {
            $feedbacks = CustomerFeedback::factory(random_int(1, 5))->create();
            $customer->customerFeedbacks()->saveMany($feedbacks);

            $customer->vehicles()->saveMany(Vehicle::factory(random_int(1, 3))->create()
                ->each(function ($vehicle) use ($employees, $feedbacks) {
                    $vehicle->appointments()->saveMany(Appointment::factory(random_int(1, 5))->create()->each(function ($appointment) use ($employees, $feedbacks) {
                        $employee = $employees->random();
                        $feedback = $feedbacks->isNotEmpty() ? $feedbacks->random() : null;

                        $faker = Factory::create();
                        $service_report_remarks = $faker->randomElement([0, 1]) === 0 ? $faker->sentences(asText: true) : null;
                        DB::table('service_reports')->insert([
                            'appt_id' => $appointment->appt_id,
                            'emp_id' => $employee->emp_id,
                            'cust_fb_id' => $feedback ? $feedback->cust_fb_id : null,
                            'service_report_remarks' => $service_report_remarks
                        ]);
                    }));
                }));
        });

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

        $roles = Role::all();
        foreach ($employees as $employee) {
            DB::table('employee_roles')->insertOrIgnore([
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
                ->insertOrIgnore([
                    'dept_id' => $deps->random()->dept_id,
                    'service_name' => $service,
                    'service_price' => Factory::create()->randomFloat(2, 20, 999)
                ]);
        }
        $services = Service::all();
        $items = InventoryItem::factory(40)->create();
//        $appointments = Appointment::factory(100)->create();
        $appointments = Appointment::all();

        foreach ($appointments as $appointment) {
            $counter = random_int(1, 3);
            for ($i = 0; $i < $counter; $i++) {
                DB::table('appointment_services')->insertOrIgnore([
                    'service_id' => $services->random()->service_id,
                    'appt_id' => $appointment->appt_id
                ]);
                DB::table('appointment_items')->insertOrIgnore([
                    'appt_id' => $appointment->appt_id,
                    'inv_item_id' => $items->random()->inv_item_id,
                    'qty_used' => random_int(1, 20)
                ]);
            }
        }

//        CustomerFeedback::factory(20)->create();

    }*/

    public function run()
    {
        // cities
        $this->call(CitySeeder::class);

        // suppliers
        $this->call(SupplierSeeder::class);

        // part categories
        $this->call(PartCategorySeeder::class);

        // parts
        $this->call(PartSeeder::class);

        // part suppliers
        $this->call(PartSupplierSeeder::class);

        // packages (for services)
        $this->call(PackageSeeder::class);

        // services
        $this->call(ServiceSeeder::class);

        // package services
        $this->call(PackageServiceSeeder::class);

        // discounts for services
        $this->call(ServiceDiscountSeeder::class);

        // memberships
        $this->call(MembershipSeeder::class);

        // services for memberships
        $this->call(MembershipServiceSeeder::class);

        // customers
        $this->call(CustomerSeeder::class);

        // emergency contacts for customers
        $this->call(EmergencyContactSeeder::class);

        // vehicle brands
        $this->call(VehicleBrandSeeder::class);

        // vehicles
        $this->call(VehicleSeeder::class);

        // branches
        $this->call(BranchSeeder::class);

    // staff per branch
    $this->call(StaffSeeder::class);

    // staff schedules
    $this->call(StaffScheduleSeeder::class);

    // staff certifications
    $this->call(StaffCertificationSeeder::class);

    // branch managers
    $this->call(BranchManagerSeeder::class);

        // bays
        $this->call(BaySeeder::class);

        // bay inspections
        $this->call(BayInspectionSeeder::class);

        // bookings
        $this->call(BookingSeeder::class);

        // booking packages (rare)
        $this->call(BookingPackagesSeeder::class);

        // invoices
        $this->call(InvoiceSeeder::class);

        // booking services (individual services attached to bookings)
        $this->call(BookingServicesSeeder::class);

    $this->call(RoleSeeder::class);
        // staff roles (pivot)
    $this->call(StaffRoleSeeder::class);

    }
}

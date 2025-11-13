<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::factory()
            ->count(60)
            ->withMembership()
            ->create();

        Customer::factory()
            ->count(70)
            ->withExpiredMembership()
            ->create();

        Customer::factory()
            ->count(200)
            ->create();
    }
}

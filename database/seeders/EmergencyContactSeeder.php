<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\EmergencyContact;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmergencyContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $customers = Customer::all();

        $contactsCreated = 0;

        foreach ($customers as $customer) {
            // Random distribution: 0, 1, or 2 contacts
            // 30% no contacts, 40% one contact, 30% two contacts
            $rand = rand(1, 100);
            if ($rand <= 30) {
                $numberOfContacts = 0;
            } elseif ($rand <= 70) {
                $numberOfContacts = 1;
            } else {
                $numberOfContacts = 2;
            }

            if ($numberOfContacts === 0) {
                continue; // Skip customers with no emergency contacts
            }

            // First contact - prefer mobile or landline
            $firstType = fake()->randomElement(['MOBILE', 'MOBILE', 'LANDLINE', 'EMAIL']);

            EmergencyContact::create([
                'cust_id' => $customer->cust_id,
                'emg_type' => $firstType,
                'emg_contact' => $this->generateContact($firstType),
            ]);

            $contactsCreated++;

            // Second contact if needed - ensure it's different type
            if ($numberOfContacts === 2) {
                // Choose a different type for variety
                $availableTypes = array_diff(['MOBILE', 'LANDLINE', 'EMAIL'], [$firstType]);
                $secondType = fake()->randomElement(array_values($availableTypes));

                EmergencyContact::create([
                    'cust_id' => $customer->cust_id,
                    'emg_type' => $secondType,
                    'emg_contact' => $this->generateContact($secondType),
                ]);

                $contactsCreated++;
            }
        }

    }

    /**
     * Generate contact based on type
     */
    private function generateContact(string $type): string
    {
        return match($type) {
            'LANDLINE' => '01' . fake()->numerify('#########'),
            'MOBILE' => '07' . fake()->numerify('#########'),
            'EMAIL' => fake()->safeEmail(),
        };
    }
}

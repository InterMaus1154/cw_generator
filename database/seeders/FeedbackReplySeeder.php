<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\CustomerFeedback;
use App\Models\Staff;
use App\Models\Customer;

class FeedbackReplySeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();
        $feedbacks = CustomerFeedback::all();
        if ($feedbacks->isEmpty()) return;

        foreach ($feedbacks as $fb) {
            // 0..3 replies
            $count = rand(0, 3);
            $parent = null;
            for ($i = 0; $i < $count; $i++) {
                $isStaff = random_int(0, 1) === 1;
                $staffId = $isStaff ? Staff::inRandomOrder()->first()?->staff_id : null;
                $custId = ! $isStaff ? Customer::inRandomOrder()->first()?->cust_id : null;

                DB::table('feedback_replies')->insert([
                    'cust_fb_id' => $fb->cust_fb_id,
                    'staff_id' => $staffId,
                    'cust_id' => $custId,
                    'reply_to' => $parent,
                    'reply_content' => $faker->sentence(10),
                ]);

                // randomly set this reply as parent for next
                if (random_int(1, 100) <= 40) {
                    $lastId = DB::getPdo()->lastInsertId();
                    $parent = $lastId ?: null;
                }
            }
        }
    }
}

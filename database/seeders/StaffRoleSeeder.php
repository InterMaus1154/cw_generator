<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Staff;
use App\Models\Role;
use App\Models\BranchManager;

class StaffRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = Role::all();
        $staffs = Staff::all();

        if ($roles->isEmpty() || $staffs->isEmpty()) {
            return;
        }

        foreach ($staffs as $staff) {
            // assign between 1 and 3 distinct roles per staff
            $count = random_int(1, min(3, $roles->count()));
            $chosen = $roles->random($count);

            foreach ($chosen as $role) {
                DB::table('staff_roles')->insertOrIgnore([
                    'role_id' => $role->role_id,
                    'staff_id' => $staff->staff_id
                ]);
            }
        }

        // Ensure active branch managers get the 'Branch Manager' role
        $bmRole = Role::where('role_name', 'Branch Manager')->first();
        if ($bmRole) {
            $activeManagers = BranchManager::where('is_active', true)->get();
            foreach ($activeManagers as $mgr) {
                DB::table('staff_roles')->insertOrIgnore([
                    'role_id' => $bmRole->role_id,
                    'staff_id' => $mgr->staff_id
                ]);
            }
        }
    }
}

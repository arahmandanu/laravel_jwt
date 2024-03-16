<?php

namespace Database\Seeders;

use App\Enum\Users\UserRoles;
use App\Models\Role;
use Illuminate\Database\Seeder;

class CreateRoles extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = UserRoles::ADMIN();
        $staff = UserRoles::STAFF();

        Role::create(['name' => $admin]);
        Role::create(['name' => $staff]);
    }
}

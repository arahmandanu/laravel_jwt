<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enum\Users\UserRoles;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::firstOrCreate([
            'name' => 'Adrian Rahmandanu',
            'email' => 'missutsan@example.com',
            'password' => Hash::make('password')
        ]);

        $role = UserRoles::ADMIN()->getValue();
        $admin->assignRole($role);
    }
}

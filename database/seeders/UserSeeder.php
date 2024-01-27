<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enum\Users\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Adrian Rahmandanu',
            'email' => 'missutsan@example.com',
            'password' => Hash::make('password'),
            'role' => Role::ADMIN()
        ]);
    }
}

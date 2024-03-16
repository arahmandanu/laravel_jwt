<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CreateRoles::class,
            UserSeeder::class,
        ]);

        if (App::environment(['local', 'staging', 'development'])) {
            $this->call([
                DevelopmentUserSeeder::class
            ]);
        }
    }
}

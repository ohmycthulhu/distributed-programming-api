<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         \App\Models\User::factory(10)->create();
         \App\Models\User::factory(1, ['access_level' => 'ADMIN', 'email' => 'admin@email.com'])->create();
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
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
       //  \App\Models\User::factory(1000)->create();
        User::create([
            'name' => 'admin',
            'email' => 'leonardo.maldonado@sattlink.com',
            'password' => bcrypt('12345678')
        ]);

    }
}

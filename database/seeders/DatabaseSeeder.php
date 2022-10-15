<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // User::factory()->create([
        //     'username'  => 'febryan1453',
        //     'email'     => 'febryan1453@gmail.com',
        //     'name'      => 'Febryan',
        //     'password'  => Hash::make('1234'),
        //     'role'      => 1,
        // ]);

        $this->call([
            UserSeeder::class
        ]);
    }
}

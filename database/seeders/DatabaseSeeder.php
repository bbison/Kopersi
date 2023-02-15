<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Bagas',
            'password'=>bcrypt('1234')
        ]);
        \App\Models\User::factory()->create([
            'name' => 'admin',
            'password'=>bcrypt('1234'),
            'hak_akses'=>'Admin'
        ]);
    }
}

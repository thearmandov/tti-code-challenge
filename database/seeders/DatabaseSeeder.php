<?php

namespace Database\Seeders;

use Str;
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
        \App\Models\User::factory()->create([
            'id' => 1,
            'first_name' => "Doctor 1",
            'last_name' => "Last Name",
            'email' => 'doctor1@test.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);

        \App\Models\User::factory()->create([
            'id' => 2,
            'first_name' => "Doctor 2",
            'last_name' => "Last Name",
            'email' => 'doctor2@test.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);

        \App\Models\User::factory(28)->create();

        \App\Models\Doctor::create(['user_id' => 1])->save();
        \App\Models\Doctor::create(['user_id' => 2])->save();
        
        for ($i = 3; $i <= 20; $i++) {
            \App\Models\Patient::create(['user_id'=> $i, 'doctor_id' => 1])->save();
        }

        for ($i = 21; $i <= 30; $i++) {
            \App\Models\Patient::create(['user_id'=> $i, 'doctor_id' => 2])->save();
        }

    }
}

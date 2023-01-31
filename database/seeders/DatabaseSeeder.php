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
        \App\Models\User::factory(30)->create();

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

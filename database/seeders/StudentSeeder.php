<?php

namespace Database\Seeders;

use App\Models\student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        for ($i = 0; $i < 5; $i++) {
        student::insert([
            'name' => fake()->name(),
            'email' => fake()->unique()->email(),
            'age'=> fake()->numberBetween(0,100),
            'address'=>fake()->address(),
            'city'=>fake()->numberBetween(1,6)
        ]);
    }
    }
}

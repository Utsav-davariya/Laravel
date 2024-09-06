<?php

namespace Database\Seeders;

use App\Models\lecturers;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LecturersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        for ($i = 0; $i < 5; $i++) {
           lecturers ::insert([
                'name' => fake()->name(),
                'email' => fake()->unique()->email(),
                'age'=> fake()->numberBetween(0,100),
                'address'=>fake()->address(),
                'city'=>fake()->numberBetween(1,6)
            ]);
        }
    }
}

<?php

namespace Database\Seeders;
use App\Models\student;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // $this->call([
        //     ProductSeeder::class,
        //     // StudentSeeder::class,
        // ]);
    //     $faker = Faker::create();

    //     for ($i = 0; $i < 20; $i++) {
    //         DB::table('blogs')->insert([
    //             'title' => $faker->sentence($nbWords = 3, $variableNbWords = true),
    //             'description' => $faker->paragraph($nbSentences = 1, $variableNbSentences = true),
    //             'content' => $faker->text($maxNbChars = 20),
    //         ]);
    //     }

        student::factory()->count(5)->create();

    }
}


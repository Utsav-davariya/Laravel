<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Facades\File;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //  Product::create([        // if one record
        //    'name'=> 'virat kohli',
        // 'owner'=> 'virat@.com',
        // ]);



        // $products = collect(        // if multiple record
        //     [           
        //         [
        //             'name' => "sachin",
        //             'owner' => 'tedulkar@.com'
        //         ],
        //         [
        //             'name' => "sanjay",
        //             'owner' => 'sanjay@.com'
        //         ],
        //         [
        //             'name' => "dhavan",
        //             'owner' => 'shukhar@.com'
        //         ]
        //     ]

        // );

        // $products->each(function ($product) {
        //  student::insert($student);
        // });



        // $json = File::get(path: 'database\json\product.json');         // read json file
        // $products = collect(json_decode($json));

        // $products->each(function ($product) {
        //     Product::create([
        //         // 'name' => $product->name,
        //         // 'owner' => $product->owner,

        //     ]);
        // });

        
        for ($i = 0; $i <= 5; $i++) {
            Product::create([       // if fake record insert
                'name' => fake()->name(),
                'owner' => fake()->unique()->email(),
                // 'description'=> fake()->name(),
                'stock'=> fake()->numberBetween($min = 0, $max = 100),
            ]);
        }

        


    }
}

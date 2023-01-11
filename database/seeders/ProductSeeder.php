<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1, 100) as $value) {
            DB::table('products')->insert([
                'title' => $faker->title(),
                'description' =>  $faker->text(),
                'price' => rand(300, 1000),
                'discountPercentage' => rand(3.95, 9.85),
                'rating' => rand(1, 100),
                'stock' => rand(1, 50),
                'brand' => $faker->word(),
                'image' => $faker->imageUrl(640, 480, 'products', true),
                'category_id' => Category::inRandomOrder()->first()->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

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
                'image' => $faker->image,
                'price' => rand(300, 1000),
                'category_id' => Category::inRandomOrder()->first()->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

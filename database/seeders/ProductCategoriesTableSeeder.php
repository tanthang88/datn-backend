<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class ProductCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        foreach (range(1, 10) as $value) {
            DB::table('product_categories')->insert([
                'category_name' => $faker->name,
                'category_slug' => Str::slug($faker->sentence(5), '-'),
                'category_image' => $faker->imageUrl($width = 200, $height = 200),
                'category_desc' => $faker->sentence,
                'category_content' => $faker->sentence(500),
                'seo_title'=>$faker->sentence,
                'seo_description'=>$faker->sentence,
                'seo_keywords'=>$faker->sentence,
                'parent_id'=>$faker->numberBetween($min = 0, $max = 9),
            ]);
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker=Faker::create();
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        foreach(range(1,10) as $value){
            DB::table('products')->insert([
                'product_name' =>$faker->name,
                'product_slug'=>Str::slug($faker->sentence(5),'-'),
                'product_image'=>$faker->imageUrl($width = 200, $height = 200),
                'product_price'=>$faker->numerify($string = '###'),
                'product_quantity'=>$faker->numerify($string = '###'),
                'product_outstanding'=>$faker->boolean(),
                'is_selling'=>$faker->boolean(),
                'product_desc'=>$faker->sentence,
                'product_content'=>$faker->sentence(500),
                'product_promotion_desc'=>$faker->sentence(100),
                'seo_title'=>$faker->sentence,
                'seo_description'=>$faker->sentence,
                'seo_keywords'=>$faker->sentence,
                'category_id'=>$faker->numberBetween($min = 1, $max = 10),
                'supplier_id'=>$faker->numberBetween($min = 1, $max = 10),
                'is_variation'=>$faker->boolean(),
                'is_discount_product'=>$faker->boolean()
            ]);
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
    }
}

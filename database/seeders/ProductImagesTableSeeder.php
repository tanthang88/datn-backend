<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class ProductImagesTableSeeder extends Seeder
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
            DB::table('product_images')->insert([
                'image' => $faker->imageUrl($width = 200, $height = 200),
                'product_id' => $faker->numberBetween($min = 1, $max = 10),
            ]);
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
    }
}

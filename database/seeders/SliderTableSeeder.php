<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Slider;
use Illuminate\Support\Str;
class SliderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker=Faker::create();
        foreach(range(1,10) as $value){
            Slider::insert([
                'title' => $faker->name,
                'image' => $faker->imageUrl($width = 200, $height = 200),
                'link' => $faker->domainName,
                'type' => Str::slug($faker->sentence(2), '-'),
            ]);
        }
    }
}

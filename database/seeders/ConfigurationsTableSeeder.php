<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
class ConfigurationsTableSeeder extends Seeder
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
            DB::table('configurations')->insert([
                'config_screen' =>$faker->name,
                'config_cpu'=>$faker->name,
                'config_system'=>$faker->name,
                'config_battery'=>$faker->name,
                'config_selfie'=>$faker->name,
                'config_camera'=>$faker->name,
                'config_ram'=>$faker->name,
                'product_id'=>$faker->numberBetween($min = 1, $max = 10),
            ]);
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
    }
}

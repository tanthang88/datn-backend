<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities = file_get_contents('https://provinces.open-api.vn/api/p/');
        $cities = json_decode($cities);
        DB::table('cities')->truncate();
        foreach ($cities as $city) {
            DB::table('cities')->insert([
                "name" => $city->name,
                "code" => $city->code,
                "slug" => Str::slug($city->name, '-'),
                "transport_fee" => 0,
            ]);
        }
    }
}

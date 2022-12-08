<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DistsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dists = file_get_contents('https://provinces.open-api.vn/api/d/');
        $dists = json_decode($dists);
        DB::table('dists')->truncate();
        foreach ($dists as $dist) {
            DB::table('dists')->insert([
                "name" => $dist->name,
                "code" => $dist->province_code,
                "slug" => Str::slug($dist->name, '-'),
                "transport_fee" => 0,
            ]);
        }
    }
}

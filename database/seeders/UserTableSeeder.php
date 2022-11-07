<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();
        $now = \Carbon\Carbon::now();
        for ($i = 0; $i < 50; $i++) {
            DB::table('users')->insert([
                'password' =>
                Hash::make(User::PASSWORD_DEFAULT),
                'email' => Str::random(10) . '@gmail.com',
                'name' => 'Tran Van ' . Str::random(5),
                'birthday' => $now,
                'gender' => rand(1, 0),
                'tel' => rand(1000000000, 9999999999),
                'city_id' => rand(1, 50),
                'dist_id' => 0,
                'address' => Str::random(10),
                'status' => rand(0, 1),
                'created_at' => $now,
            ]);
        }
    }
}

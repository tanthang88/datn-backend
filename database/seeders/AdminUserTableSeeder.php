<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin_role_user')->truncate();
        $now = \Carbon\Carbon::now();
        DB::table('admin_role_user')->insert([
            [
                'role_id' => '1',
                'user_id' => '1',
            ],
            [
                'role_id' => '1',
                'user_id' => '2',
            ],
            [
                'role_id' => '1',
                'user_id' => '3',
            ],
            [
                'role_id' => '1',
                'user_id' => '4',
            ],
                        [
                'role_id' => '1',
                'user_id' => '5',
            ],
            [
                'role_id' => '1',
                'user_id' => '6',
            ],
        ]);
    }
}

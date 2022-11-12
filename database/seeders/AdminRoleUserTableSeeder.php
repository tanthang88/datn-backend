<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminRoleUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin_users')->truncate();
        $now = \Carbon\Carbon::now();
        DB::table('admin_users')->insert([
            [
                'name' => 'Đoàn Văn Long',
                'email' => 'doanvanlong@gmail.com',
                'password' => Hash::make(User::PASSWORD_DEFAULT),
                'birthday' => '1995-01-02',
                'gender' => 1,
                'tel' => '0973126992'
            ],
            [
                'name' => 'Ngô Bảo Quân',
                'email' => 'ngobaoquan@gmail.com',
                'password' => Hash::make(User::PASSWORD_DEFAULT),
                'birthday' => '1995-01-02',
                'gender' => 1,
                'tel' => '0973126992'
            ],
            [
                'name' => 'Phạm Tấn Thắng',
                'email' => 'phamtanthang@gmail.com',
                'password' => Hash::make(User::PASSWORD_DEFAULT),
                'birthday' => '1995-01-02',
                'gender' => 1,
                'tel' => '0973126992'
            ],
            [
                'name' => 'Hoàng Văn Anh',
                'email' => 'hoangvananh@gmail.com',
                'password' => Hash::make(User::PASSWORD_DEFAULT),
                'birthday' => '1995-01-02',
                'gender' => 1,
                'tel' => '0973126992'
            ],
                        [
                'name' => 'Nguyễn Phú Tài',
                'email' => 'nguyenphutai@gmail.com',
                'password' => Hash::make(User::PASSWORD_DEFAULT),
                'birthday' => '1995-01-02',
                'gender' => 1,
                'tel' => '0973126992'
            ],
            [
                'name' => 'Trần Văn Trung',
                'email' => 'tranvantrung@gmail.com',
                'password' => Hash::make(User::PASSWORD_DEFAULT),
                'birthday' => '1995-01-02',
                'gender' => 1,
                'tel' => '0973126992'
            ],
        ]);
    }
}

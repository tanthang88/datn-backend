<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin_roles')->truncate();
        $now = \Carbon\Carbon::now();
        DB::table('admin_roles')->insert([
            [
                'name' => 'admin',
                'display_name' => 'Quản trị hệ thống',
                'created_at' => $now
            ],
            [
                'name' => 'manage',
                'display_name' => 'Quản lý cửa hàng',
                'created_at' => $now
            ],
            [
                'name' => 'business_man',
                'display_name' => 'Quản lý sản phẩm, quản lý đơn hàng, quản lý kho',
                'created_at' => $now
            ],
            [
                'name' => 'content',
                'display_name' => 'Quản lý nội dung bài viết và sản phẩm',
                'created_at' => $now
            ],
            [
                'name' => 'support',
                'display_name' => 'Tư vấn và hổ trợ khách hàng',
                'created_at' => $now
            ],
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminPermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin_permissions')->truncate();
        $now = \Carbon\Carbon::now();
        DB::table('admin_permissions')->insert([
            [
                'id' => 1,
                'name' => 'Bài viết',
                'display_name' => 'Quản lý bài viết',
                'parent_id' => 0,
                'key_code' => 'view_post',
                'created_at' => $now
            ],
            [
                'id' => 2,
                'name' => 'Quản lý layout website',
                'display_name' => 'Quản lý Banner-Slider',
                'parent_id' => 0,
                'key_code' => 'view_content_layout',
                'created_at' => $now
            ],
            [
                'id' => 3,
                'name' => 'Sản phẩm',
                'display_name' => 'Quản lý sản phẩm',
                'parent_id' => 0,
                'key_code' => 'view_product',
                'created_at' => $now
            ],
            [
                'id' => 4,
                'name' => 'Khách hàng',
                'display_name' => 'Quản lý khách hàng',
                'parent_id' => 0,
                'key_code' => 'view_user',
                'created_at' => $now
            ],
            [
                'id' => 5,
                'name' => 'Nhân viên',
                'display_name' => 'Quản lý nhân viên',
                'parent_id' => 0,
                'key_code' => 'view_staff',
                'created_at' => $now
            ],
            [
                'id' => 6,
                'name' => 'Phân quyền',
                'display_name' => 'Quản lý phân quyền',
                'parent_id' => 0,
                'key_code' => 'view_role',
                'created_at' => $now
            ],
            [
                'id' => 7,
                'name' => 'Đơn hàng',
                'display_name' => 'Quản lý đơn hàng',
                'parent_id' => 0,
                'key_code' => 'view_bill',
                'created_at' => $now
            ],
            [
                'id' => 8,
                'name' => 'Bình luận',
                'display_name' => 'Quản lý bình luận',
                'parent_id' => 0,
                'key_code' => 'view_comment',
                'created_at' => $now
            ],
            [
                'id' => 9,
                'name' => 'Thanh toán',
                'display_name' => 'Quản lý thanh toán',
                'parent_id' => 0,
                'key_code' => 'view_payment',
                'created_at' => $now
            ],
            [
                'id' => 10,
                'name' => 'Khuyến mãi',
                'display_name' => 'Quản lý khuyến mãi',
                'parent_id' => 0,
                'key_code' => 'view_promotion',
                'created_at' => $now
            ],
            [
                'id' => 11,
                'name' => 'Phí ship',
                'display_name' => 'Quản lý phí ship',
                'parent_id' => 0,
                'key_code' => 'view_feeship',
                'created_at' => $now
            ],
        ]);
    }
}

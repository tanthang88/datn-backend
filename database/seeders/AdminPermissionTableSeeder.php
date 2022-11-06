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
                'name' => 'category',
                'display_name' => 'Quản lý danh mục',
                'parent_id' => 0,
                'key_code' => 0,
                'created_at' => $now
            ],
            [
                'id' => 2,
                'name' => 'Danh sách',
                'display_name' => 'Danh sách',
                'parent_id' => 1,
                'key_code' => 'list_category',
                'created_at' => $now
            ],
            [
                'id' => 3,
                'name' => 'Thêm',
                'display_name' => 'Thêm',
                'parent_id' => 1,
                'key_code' => 'add_category',
                'created_at' => $now
            ],
            [
                'id' => 4,
                'name' => 'Sửa',
                'display_name' => 'Sửa',
                'parent_id' => 1,
                'key_code' => 'edit_category',
                'created_at' => $now
            ],
            [
                'id' => 5,
                'name' => 'Xoá',
                'display_name' => 'Xoá',
                'parent_id' => 1,
                'key_code' => 'delete_category',
                'created_at' => $now
            ],
            [
                'id' => 6,
                'name' => 'post',
                'display_name' => 'Quản lý bài viết',
                'parent_id' => 0,
                'key_code' => 0,
                'created_at' => $now
            ],
            [
                'id' => 7,
                'name' => 'Danh sách',
                'display_name' => 'Danh sách',
                'parent_id' => 6,
                'key_code' => 'list_post',
                'created_at' => $now
            ],
            [
                'id' => 8,
                'name' => 'Thêm',
                'display_name' => 'Thêm',
                'parent_id' => 6,
                'key_code' => 'add_post',
                'created_at' => $now
            ],
            [
                'id' => 9,
                'name' => 'Sửa',
                'display_name' => 'Sửa',
                'parent_id' => 6,
                'key_code' => 'edit_post',
                'created_at' => $now
            ],
            [
                'id' => 10,
                'name' => 'Xoá',
                'display_name' => 'Xoá',
                'parent_id' => 6,
                'key_code' => 'delete_post',
                'created_at' => $now
            ],
            [
                'id' => 11,
                'name' => 'content_layout',
                'display_name' => 'quản lý banner-slide trang web',
                'parent_id' => 0,
                'key_code' => 0,
                'created_at' => $now
            ],
            [
                'id' => 12,
                'name' => 'Danh sách',
                'display_name' => 'Danh sách',
                'parent_id' => 11,
                'key_code' => 'list_content_layout',
                'created_at' => $now
            ],
            [
                'id' => 13,
                'name' => 'Thêm',
                'display_name' => 'Thêm',
                'parent_id' => 11,
                'key_code' => 'add_content_layout',
                'created_at' => $now
            ],
            [
                'id' => 14,
                'name' => 'Sửa',
                'display_name' => 'Sửa',
                'parent_id' => 11,
                'key_code' => 'edit_content_layout',
                'created_at' => $now
            ],
            [
                'id' => 15,
                'name' => 'Xoá',
                'display_name' => 'Xoá',
                'parent_id' => 11,
                'key_code' => 'delete_content_layout',
                'created_at' => $now
            ],
            [
                'id' => 16,
                'name' => 'product',
                'display_name' => 'quản lý sản phẩm',
                'parent_id' => 0,
                'key_code' => 0,
                'created_at' => $now
            ],
            [
                'id' => 17,
                'name' => 'Danh sách',
                'display_name' => 'Danh sách',
                'parent_id' => 16,
                'key_code' => 'list_product',
                'created_at' => $now
            ],
            [
                'id' => 18,
                'name' => 'Thêm',
                'display_name' => 'Thêm',
                'parent_id' => 16,
                'key_code' => 'add_product',
                'created_at' => $now
            ],
            [
                'id' => 19,
                'name' => 'Sửa',
                'display_name' => 'Sửa',
                'parent_id' => 16,
                'key_code' => 'edit_product',
                'created_at' => $now
            ],
            [
                'id' => 20,
                'name' => 'Xoá',
                'display_name' => 'Xoá',
                'parent_id' => 16,
                'key_code' => 'delete_product',
                'created_at' => $now
            ],
            [
                'id' => 21,
                'name' => 'user',
                'display_name' => 'quản lý khách hàng',
                'parent_id' => 0,
                'key_code' => 0,
                'created_at' => $now
            ],
            [
                'id' => 22,
                'name' => 'Danh sách',
                'display_name' => 'Danh sách',
                'parent_id' => 21,
                'key_code' => 'list_user',
                'created_at' => $now
            ],
            [
                'id' => 23,
                'name' => 'Thêm',
                'display_name' => 'Thêm',
                'parent_id' => 21,
                'key_code' => 'add_user',
                'created_at' => $now
            ],
            [
                'id' => 24,
                'name' => 'Sửa',
                'display_name' => 'Sửa',
                'parent_id' => 21,
                'key_code' => 'edit_user',
                'created_at' => $now
            ],
            [
                'id' => 25,
                'name' => 'Xoá',
                'display_name' => 'Xoá',
                'parent_id' => 21,
                'key_code' => 'delete_user',
                'created_at' => $now
            ],
            [
                'id' => 26,
                'name' => 'staff',
                'display_name' => 'quản lý nhân viên website',
                'parent_id' => 0,
                'key_code' => 0,
                'created_at' => $now
            ],
            [
                'id' => 27,
                'name' => 'Danh sách',
                'display_name' => 'Danh sách',
                'parent_id' => 26,
                'key_code' => 'list_staff',
                'created_at' => $now
            ],
            [
                'id' => 28,
                'name' => 'Thêm',
                'display_name' => 'Thêm',
                'parent_id' => 26,
                'key_code' => 'add_staff',
                'created_at' => $now
            ],
            [
                'id' => 29,
                'name' => 'Sửa',
                'display_name' => 'Sửa',
                'parent_id' => 26,
                'key_code' => 'edit_staff',
                'created_at' => $now
            ],
            [
                'id' => 30,
                'name' => 'Xoá',
                'display_name' => 'Xoá',
                'parent_id' => 26,
                'key_code' => 'delete_staff',
                'created_at' => $now
            ],
            [
                'id' => 31,
                'name' => 'role',
                'display_name' => 'quản lý phân quyền',
                'parent_id' => 0,
                'key_code' => 0,
                'created_at' => $now
            ],
            [
                'id' => 32,
                'name' => 'Danh sách',
                'display_name' => 'Danh sách',
                'parent_id' => 31,
                'key_code' => 'list_role',
                'created_at' => $now
            ],
            [
                'id' => 33,
                'name' => 'Thêm',
                'display_name' => 'Thêm',
                'parent_id' => 31,
                'key_code' => 'add_role',
                'created_at' => $now
            ],
            [
                'id' => 34,
                'name' => 'Sửa',
                'display_name' => 'Sửa',
                'parent_id' => 31,
                'key_code' => 'edit_role',
                'created_at' => $now
            ],
            [
                'id' => 35,
                'name' => 'Xoá',
                'display_name' => 'Xoá',
                'parent_id' => 31,
                'key_code' => 'delete_role',
                'created_at' => $now
            ],
            [
                'id' => 36,
                'name' => 'bill',
                'display_name' => 'quản lý đơn hàng',
                'parent_id' => 0,
                'key_code' => 0,
                'created_at' => $now
            ],
            [
                'id' => 37,
                'name' => 'Danh sách',
                'display_name' => 'Danh sách',
                'parent_id' => 36,
                'key_code' => 'list_bill',
                'created_at' => $now
            ],
            [
                'id' => 38,
                'name' => 'Thêm',
                'display_name' => 'Thêm',
                'parent_id' => 36,
                'key_code' => 'add_bill',
                'created_at' => $now
            ],
            [
                'id' => 39,
                'name' => 'Sửa',
                'display_name' => 'Sửa',
                'parent_id' => 36,
                'key_code' => 'edit_bill',
                'created_at' => $now
            ],
            [
                'id' => 40,
                'name' => 'Xoá',
                'display_name' => 'Xoá',
                'parent_id' => 36,
                'key_code' => 'delete_bill',
                'created_at' => $now
            ],
            [
                'id' => 41,
                'name' => 'warehouse',
                'display_name' => 'quản lý kho',
                'parent_id' => 0,
                'key_code' => 0,
                'created_at' => $now
            ],
            [
                'id' => 42,
                'name' => 'Danh sách',
                'display_name' => 'Danh sách',
                'parent_id' => 41,
                'key_code' => 'list_warehouse',
                'created_at' => $now
            ],
            [
                'id' => 43,
                'name' => 'Thêm',
                'display_name' => 'Thêm',
                'parent_id' => 41,
                'key_code' => 'add_warehouse',
                'created_at' => $now
            ],
            [
                'id' => 44,
                'name' => 'Sửa',
                'display_name' => 'Sửa',
                'parent_id' => 41,
                'key_code' => 'edit_warehouse',
                'created_at' => $now
            ],
            [
                'id' => 45,
                'name' => 'Xoá',
                'display_name' => 'Xoá',
                'parent_id' => 41,
                'key_code' => 'delete_warehouse',
                'created_at' => $now
            ],
            [
                'id' => 46,
                'name' => 'comment',
                'display_name' => 'quản lý bình luận',
                'parent_id' => 0,
                'key_code' => 0,
                'created_at' => $now
            ],
            [
                'id' => 47,
                'name' => 'Danh sách',
                'display_name' => 'Danh sách',
                'parent_id' => 46,
                'key_code' => 'list_comment',
                'created_at' => $now
            ],
            [
                'id' => 48,
                'name' => 'Thêm',
                'display_name' => 'Thêm',
                'parent_id' => 46,
                'key_code' => 'add_comment',
                'created_at' => $now
            ],
            [
                'id' => 49,
                'name' => 'Sửa',
                'display_name' => 'Sửa',
                'parent_id' => 46,
                'key_code' => 'edit_comment',
                'created_at' => $now
            ],
            [
                'id' => 50,
                'name' => 'Xoá',
                'display_name' => 'Xoá',
                'parent_id' => 46,
                'key_code' => 'delete_comment',
                'created_at' => $now
            ],
            [
                'id' => 51,
                'name' => 'payment',
                'display_name' => 'quản lý thanh toán',
                'parent_id' => 0,
                'key_code' => 0,
                'created_at' => $now
            ],
            [
                'id' => 52,
                'name' => 'Danh sách',
                'display_name' => 'Danh sách',
                'parent_id' => 51,
                'key_code' => 'list_payment',
                'created_at' => $now
            ],
            [
                'id' => 53,
                'name' => 'Thêm',
                'display_name' => 'Thêm',
                'parent_id' => 51,
                'key_code' => 'add_payment',
                'created_at' => $now
            ],
            [
                'id' => 54,
                'name' => 'Sửa',
                'display_name' => 'Sửa',
                'parent_id' => 51,
                'key_code' => 'edit_payment',
                'created_at' => $now
            ],
            [
                'id' => 55,
                'name' => 'Xoá',
                'display_name' => 'Xoá',
                'parent_id' => 51,
                'key_code' => 'delete_payment',
                'created_at' => $now
            ],

        ]);
    }
}

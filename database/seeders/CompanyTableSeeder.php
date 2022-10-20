<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('companies')->truncate();
        DB::table('companies')->insert([
            ['company_name'=>'Điện thoại- Phụ kiện | SnackMobile','company_slug'=>'','company_email'=>'snackmobile.contact@gmail.com','company_phone'=>'0123456789','company_address'=>'137 Nguyễn THị Thập  - Hoà Minh  - Liên Chiểu -Tp Đà Nẵng','company_copyright'=>'Snackmobile','company_work_time'=>'8:00 - 21:00','company_work_day'=>'Thứ 2 đến Chủ nhật','company_ggmap'=>'','company_hotline'=>'0808080808','seo_title'=>'Điện thoại - Phụ Kiện | SnackMobile','seo_keyword'=>'điện thoại di dộng,dien thoai chinh hang,điện thoại, dien thoai di dong','seo_description'=>'Hàng 100% chính hãng được phân phối bởi hệ thống bán lẻ SnackMobile cùng với nhiều khuyến mãi hấp dẫn, bảo hành chính hãng. Mua trực tuyến giá rẻ hơn.']
        ]);
    }
}

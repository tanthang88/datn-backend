<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AboutTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('abouts')->truncate();
        DB::table('abouts')->insert([
            ['about_name'=>'Giới thiệu về công ty','about_slug'=>'gioi-thieu-ve-cong-ty','type'=>'gioi-thieu','about_desc'=>'Công ty Cổ phần Bán lẻ Kỹ thuật số FPT (gọi tắt là FPT Retail) là công ty liên kết của Tập đoàn FPT Việt Nam, được thành lập vào ngày 8/3/2012 với hai thương hiệu chính là FPT Shop và F.Studio By FPT – Đại lý được ủy quyền chính thức của Apple tại Việt Nam ở cấp độ cao cấp nhất.','about_content'=>'Công ty Cổ phần Bán lẻ Kỹ thuật số FPT (gọi tắt là FPT Retail) được thành lập từ năm 2012 tại Việt Nam, là công ty liên kết của Tập đoàn FPT, sở hữu 2 chuỗi bán lẻ là FPT Shop, F.Studio By FPT và 1 công ty con là Công ty Cổ phần Dược phẩm FPT Long Châu. Hệ thống bán lẻ FPT Shop là chuỗi chuyên bán lẻ các sản phẩm kỹ thuật số di động bao gồm điện thoại di động, máy tính bảng, laptop, phụ kiện và dịch vụ công nghệ… FPT Shop là hệ thống bán lẻ đầu tiên ở Việt Nam được cấp chứng chỉ ISO 9001:2000 về quản lý chất lượng theo tiêu chuẩn quốc tế. Hiện nay, FPT Shop là chuỗi bán lẻ lớn thứ 2 trên thị trường bán lẻ hàng công nghệ. Hệ thống F.Studio By FPT là chuỗi cửa hàng được ủy quyền chính thức của Apple tại Việt Nam ở cấp độ cao cấp nhất, chuyên kinh doanh các sản phẩm chính hãng của Apple. FPT Retail là công ty đầu tiên có chuỗi bán lẻ với mô hình cửa hàng chuẩn của Apple, bao gồm: AAR (Apple Authorised Reseller) và iCorner, mang đến cho khách hàng không gian tuyệt vời để trải nghiệm những sản phẩm công nghệ độc đáo, tinh tế của Apple cùng dịch vụ bán hàng và chất lượng chăm sóc khách hàng cao cấp và thân thiện nhất. Công ty Cổ phần Dược phẩm FPT Long Châu: Sở hữu chuỗi nhà thuốc Long Châu chuyên kinh doanh dược phẩm, dụng cụ y khoa, thực phẩm chức năng chính hãng thuộc Hệ thống Bán lẻ FPT Retail. Với ưu thế về giá cả cạnh tranh, chất lượng sản phẩm đạt chuẩn cùng đội ngũ dược sĩ có trình độ chuyên môn cao, được đào tạo bài bản, nhà thuốc Long Châu là địa chỉ uy tín và đáng tin cậy cho sức khỏe của khách hàng. Trong suốt nhiều năm qua, bằng những nỗ lực không mệt mỏi, trung thành với chính sách “tận tâm phục vụ khách hàng”, FPT Retail quyết tâm hoạt động, xây dựng phong cách phục vụ khách hàng cho tất cả các mảng kinh doanh dù mới hay cũ, lấy đó làm nền tảng tăng trưởng bền vững, hoàn thiện hình ảnh một thương hiệu gần gũi, thân thiện và hướng tới mục tiêu phục vụ khách hàng là ưu tiên hàng đầu. Sự đầu tư nghiêm túc và nỗ lực không ngừng của FPT Retail đã được cộng đồng ghi nhận qua số lượt khách hàng đến tham quan mua sắm tăng mạnh và ổn định trong suốt nhiều năm qua. Sau 10 năm hoạt động, FPT Retail đã tạo dựng được niềm tin nơi Quý khách hàng khi là nhà bán lẻ đứng thứ 1 về thị phần máy tính xách tay tại Việt Nam (từ năm 2015 đến nay), đứng thứ 2 về thị phần điện thoại và là nhà bán lẻ Apple chính hãng hàng đầu tại Việt Nam với đầy đủ các chuẩn cửa hàng từ cấp độ cao nhất. Luôn đặt khách hàng làm trung tâm trong mọi suy nghĩ và hành động, FPT Retail đã xây dựng được một đội ngũ nhân viên với phong cách làm việc chuyên nghiệp, nhiệt tình và tận tâm với khách hàng. Bên cạnh đó, chúng tôi đã, đang và sẽ tiếp tục chuyển đổi số một cách mạnh mẽ để nâng cao trải nghiệm khách hàng.','seo_title'=>'Giới thiệu','seo_keyword'=>'keyword','seo_description'=>'description'],
            ['about_name'=>'Chính sách bảo mật','about_slug'=>'chinh-sach-bao-mat','type'=>'chinh-sach','about_desc'=>'Mô tả','about_content'=>'Nội dung','seo_title'=>'Chính sách bảo mật','seo_keyword'=>'keyword','seo_description'=>'description']
        ]);
    }
}

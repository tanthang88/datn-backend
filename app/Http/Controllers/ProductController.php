<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Configuration;
use App\Models\Supplier;
use App\Models\ProductImage;
use App\Http\Requests\ProductRequest;
use Storage;


class ProductController extends Controller
{
    public function getAdd()
    {
        $categories = ProductCategory::get();
        $supplier   = Supplier::get();
        return view('pages.product.add',[
            'title'      => 'Thêm mới sản phẩm',
            'categories' => $categories,
            'supplier'   => $supplier,
        ]);
    }
    public function postAdd(ProductRequest $request)
    {
        try{
            $product = new Product;
            $configuration = new Configuration;
            // thêm thông tin sp bth
            $product->product_name    = $request->product_name;
            $product->product_slug    = (Str::slug($product->product_name,'-'));
            $product->supplier_id     = $request->supplier_id;
            $product->product_price   = $request->product_price;
            $product->product_quantity= $request->product_quantity;
            $product->product_order   = $request->product_order;
            if($request->product_outstanding == 'on'){
                $product->product_outstanding = 1;
            }else{
                $product->product_outstanding = 0;
            };
            if($request->product_display == 'on'){
                $product->product_display = 1;
            }else{
                $product->product_display = 0;
            };
            $product->category_id     = $request->category_id;
            $product->product_desc    = $request->product_desc;
            $product->product_content = $request->product_content;
            $product->seo_title       = $request->seo_title;
            $product->seo_description = $request->seo_description;
            $product->seo_keywords    = $request->seo_keywords;
            $product->save();

            // thêm thông số kỹ thuật
            $configuration->product_id      = $product->id;
            $configuration->config_screen   = $request->config_screen;
            $configuration->config_cpu      = $request->config_cpu;
            $configuration->config_ram      = $request->config_ram;
            $configuration->config_camera   = $request->config_camera;
            $configuration->config_selfie   = $request->config_selfie;
            $configuration->config_battery  = $request->config_battery;
            $configuration->config_system   = $request->config_system;
            $configuration->save();

            // thêm hình ảnh chi tiết
            // if ($request->hasFile('upload')) {
            //     foreach($request->file('upload') as $file){

            //         if(isset($file)){
            //             $name = $file->getClientOriginalName();
            //             $pathFull = 'uploads/' . date("Y-m-d");

            //             $file->storeAs(
            //                 'public/' . $pathFull, $name
            //             );

            //             $thumb = '/storage/' . $pathFull . '/' . $name;
            //             $product_images->product_id = '1';
            //             $product_images->image      = $thumb;
            //             $product_images->save();
            //         };
            //     }

            // }
            // Lưu hình ảnh liên quan
            if($request->hasFile('sp_hinhanhlienquan')) {
                $files = $request->sp_hinhanhlienquan;

                // duyệt từng ảnh và thực hiện lưu
                foreach ($request->sp_hinhanhlienquan as $index => $file) {
                        $name = $file->getClientOriginalName();
                        $pathFull = 'uploads/' . date("Y-m-d");

                        $file->storeAs(
                            'public/' . $pathFull, $name
                        );

                        $thumb = '/storage/' . $pathFull . '/' . $name;

                    // Tạo đối tưọng HinhAnh
                    $hinhAnh = new ProductImage();
                    $hinhAnh->product_id = $product->id;
                    $hinhAnh->image = $thumb;
                    $hinhAnh->save();
                }
            }
            Session::flash('success', 'Thêm sản phẩm thành công !!');

        }catch(\Exception $error){
            Session::flash('error', 'Tạo sản phẩm thất bại!!');
            return redirect()->back();
        }

        return redirect('/product/list');


    }
    public function getUpdate($id)
    {
        $categories = ProductCategory::get();
        $supplier   = Supplier::get();
        $data = Product::where('id', $id)->first();
        $configuration = Configuration::where('product_id', $id)->first();
        $image = ProductImage::where('product_id', $id)->get();
        return view('pages.product.update',[
            'title' => 'Chỉnh sửa sản phẩm',
            'categories' => $categories,
            'supplier'   => $supplier,
            'data'       => $data,
            'configuration' => $configuration,
            'image' => $image,
        ]);
    }

    public function postUpdate(ProductRequest $request, $id)
    {
        try{
            $product        = Product::find($id);
            $configuration  = Configuration::where('product_id', $id)->first();

            $product->product_name    = $request->product_name;
            $product->product_slug    = (Str::slug($product->product_name,'-'));
            $product->supplier_id     = $request->supplier_id;
            $product->product_price   = $request->product_price;
            $product->product_quantity= $request->product_quantity;
            $product->product_order   = $request->product_order;
            if($request->product_outstanding == 'on'){
                $product->product_outstanding = 1;
            }else{
                $product->product_outstanding = 0;
            };
            if($request->product_display == 'on'){
                $product->product_display = 1;
            }else{
                $product->product_display = 0;
            };

            $product->category_id     = $request->category_id;
            $product->product_desc    = $request->product_desc;
            $product->product_content = $request->product_content;
            $product->seo_title       = $request->seo_title;
            $product->seo_description = $request->seo_description;
            $product->seo_keywords    = $request->seo_keywords;
            $product->updated_at       = NOW();
            $product->save();

            $configuration->config_screen   = $request->config_screen;
            $configuration->config_cpu      = $request->config_cpu;
            $configuration->config_ram      = $request->config_ram;
            $configuration->config_camera   = $request->config_camera;
            $configuration->config_selfie   = $request->config_selfie;
            $configuration->config_battery  = $request->config_battery;
            $configuration->config_system   = $request->config_system;
            $configuration->save();

            // Lưu hình ảnh liên quan
            if ($request->hasFile('sp_hinhanhlienquan')) {
                // DELETE các dòng liên quan trong table `HinhAnh`
                foreach ($sp->product_images()->get() as $hinhAnh) {
                    // Xóa record
                    $hinhAnh->delete();
                }

                $files = $request->sp_hinhanhlienquan;

                // duyệt từng ảnh và thực hiện lưu
                foreach ($request->sp_hinhanhlienquan as $index => $file) {

                    $name = $file->getClientOriginalName();
                    $pathFull = 'uploads/' . date("Y-m-d");

                    $file->storeAs(
                        'public/' . $pathFull, $name
                    );

                    $thumb = '/storage/' . $pathFull . '/' . $name;


                     // Tạo đối tưọng HinhAnh
                     $hinhAnh = new ProductImage();
                     $hinhAnh->product_id = $product->id;
                     $hinhAnh->image = $thumb;
                     $hinhAnh->save();
                }
            }
            Session::flash('success', 'Cập nhật sản phẩm thành công !!');
        }catch(\Exception $error){
            Session::flash('error', 'Cập nhật sản phẩm thất bại!!');
            redirect()->back();
        }

        return redirect('/product/list');

    }
    public function getList(Request $request)
    {
        $data = Product::orderBy('id','desc')->paginate(20);
        if($search = $request->search){
           $data = Product::orderBy('id','desc')->where('product_name','like','%'.$search.'%')->paginate(20);
        }
        return view('pages.product.list',[
            'title'     => 'Danh sách sản phẩm',
            'data'      => $data
        ]
        );
    }
    public function delete($id)
    {
        try{
            $product = Product::where('id', $id)->first();
            $configuration  = Configuration::where('product_id', $id)->first();
            $image = ProductImage::where('product_id', $id)->get();
            if($product && $configuration){
                 // DELETE các dòng liên quan trong table `product image`
                foreach ($image as $list) {
                    // Xóa hình cũ để tránh rác
                    $nameimg = substr(($list->image),28);
                    Storage::delete('public/uploads/'.$list->image.'/' . $nameimg);

                    // Xóa record
                    $list->delete();
                }

                // Xóa hình cũ để tránh rác
                // Storage::delete('public/photos/' . $sp->sp_hinh);
                $product->delete();
                $configuration->delete();
                $image->delete();
                Session::flash('success', 'Xóa sản phẩm thành công !!');
            }
        }catch(\Exception $error){
            Session::flash('error', 'Xóa sản phẩm thất bại!!');
            return redirect()->back();
        }

        return redirect('/product/list');
    }

}

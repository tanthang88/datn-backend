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
use App\Models\Propertie;
use App\Models\Variantion;
use App\Http\Requests\ProductRequest;
use Storage;


class ProductController extends Controller
{
    public function create()
    {
        $categories = ProductCategory::get();
        $supplier   = Supplier::get();
        return view('pages.product.add',[
            'title'      => 'Thêm mới sản phẩm',
            'categories' => $categories,
            'supplier'   => $supplier,
        ]);
    }
    public function store(ProductRequest $request)
    {
            // thêm thông tin sp
            $product = new Product();
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
            $product->is_variation = $request->is_variation;
            // check ảnh sp
            if ($request->hasFile('img_product')) {
                $name = $request->file('img_product')->getClientOriginalName();
                $pathFull = 'uploads/' . date("Y-m-d");

                $request->file('img_product')->storeAs(
                    'public/' . $pathFull, $name
                );

                $thumb = '/storage/' . $pathFull . '/' . $name;
                $product->product_image = $thumb;
            }
            $product->seo_title       = $request->seo_title;
            $product->seo_description = $request->seo_description;
            $product->seo_keywords    = $request->seo_keywords;
            $product->save();

            // thêm thông số kỹ thuật
            if($request->is_configuration_product == 'on'){
                if($request->config_screen){
                    $configuration = new Configuration;
                    $configuration->product_id      = $product->id;
                    $configuration->config_screen   = $request->config_screen;
                    $configuration->config_cpu      = $request->config_cpu;
                    $configuration->config_ram      = $request->config_ram;
                    $configuration->config_camera   = $request->config_camera;
                    $configuration->config_selfie   = $request->config_selfie;
                    $configuration->config_battery  = $request->config_battery;
                    $configuration->config_system   = $request->config_system;
                    $configuration->save();
                }
            }

            // Lưu hình ảnh liên quan
            if($request->hasFile('img_list')) {
                $files = $request->img_list;

                // duyệt từng ảnh và thực hiện lưu
                foreach ($request->img_list as $index => $file) {
                        $name = $file->getClientOriginalName();
                        $pathFull = 'uploads/' . date("Y-m-d");

                        $file->storeAs(
                            'public/' . $pathFull, $name
                        );

                        $thumb = '/storage/' . $pathFull . '/' . $name;

                    // Tạo đối tượng chi tiết hình
                    $images = new ProductImage();
                    $images->product_id = $product->id;
                    $images->image = $thumb;
                    $images->save();
                }
            }

            //thêm thuộc tính
            if($request->is_variation=='1'){

                foreach($request->propertie_name as $value => $name){
                        // print_r($request->propertie_value);
                        // cắt mảng
                        $x = $request->propertie_value[$value];
                         $val = explode('|', $x);
                        echo '<pre>';
                        // print_r($list);
                        print_r($val);
                        // print_r($listValue);
                        echo '</pre>';
                        foreach($val as $list => $listValue){
                            $properties = new Propertie();
                            $properties->propertie_name = $name;
                            $properties->propertie_slug = Str::slug($name);
                            $properties->propertie_value = $listValue;
                            $properties->product_id = $product->id;
                            $properties->save();
                        }

                }
            }
        return redirect('/product')->with('success', trans('alert.add.success'));
    }
    public function show($id)
    {

        $categories = ProductCategory::get();
        $supplier   = Supplier::get();
        $data = Product::where('id', $id)->first();
        $configuration = Configuration::where('product_id', $id)->first();
        $images = ProductImage::where('product_id', $id)->get();
        $properties = Propertie::where('product_id', $id)->get();
        return view('pages.product.update',[
            'title' => 'Chỉnh sửa sản phẩm',
            'categories' => $categories,
            'supplier'   => $supplier,
            'data'       => $data,
            'configuration' => $configuration,
            'images' => $images,
            'properties' => $properties,
        ]);
    }

    public function update(Request $request, $id)
    {
            $product        = Product::find($id);
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
            if($request->is_discount_product == 'on'){
                $product->is_discount_product = 1;
            }else{
                $product->is_discount_product = 0;
            };
            $product->is_variation = $request->is_variation;
            if ($request->hasFile('img_product')) {
                // Xóa hình cũ để tránh rác
                $name = substr(($product->product_image),28);
                Storage::delete('public/uploads/'.$product->created_at.'/' . $name);

                // Upload hình mới
                // Lưu tên hình vào column sp_hinh
                $name = $request->file('img_product')->getClientOriginalName();
                $pathFull = 'uploads/' . date("Y-m-d");

                $request->file('img_product')->storeAs(
                    'public/' . $pathFull, $name
                );

                $thumb = '/storage/' . $pathFull . '/' . $name;
                $product->product_image = $thumb;

            }
            $product->seo_title       = $request->seo_title;
            $product->seo_description = $request->seo_description;
            $product->seo_keywords    = $request->seo_keywords;
            $product->updated_at       = NOW();
            $product->save();

            if($request->is_configuration_product == 'on'){
                if($request->config_screen){
                    $configuration  = Configuration::where('product_id', $id)->first();
                    if($configuration!=null){
                        $configuration->config_screen   = $request->config_screen;
                        $configuration->config_cpu      = $request->config_cpu;
                        $configuration->config_ram      = $request->config_ram;
                        $configuration->config_camera   = $request->config_camera;
                        $configuration->config_selfie   = $request->config_selfie;
                        $configuration->config_battery  = $request->config_battery;
                        $configuration->config_system   = $request->config_system;
                        $configuration->updated_at      = NOW();
                        $configuration->save();
                    }else{
                        $configuration_n = new Configuration;
                        $configuration_n->product_id      = $product->id;
                        $configuration_n->config_screen   = $request->config_screen;
                        $configuration_n->config_cpu      = $request->config_cpu;
                        $configuration_n->config_ram      = $request->config_ram;
                        $configuration_n->config_camera   = $request->config_camera;
                        $configuration_n->config_selfie   = $request->config_selfie;
                        $configuration_n->config_battery  = $request->config_battery;
                        $configuration_n->config_system   = $request->config_system;
                        $configuration_n->save();
                    }
                }
            }

            // Lưu hình ảnh liên quan
            if ($request->hasFile('img_list')) {
                // xóa các hình cũ
                foreach ($product->productImage()->get()  as $images) {
                    // Xóa record
                    $name = substr(($images->image),28);
                    Storage::delete('public/uploads/'.$images->created_at.'/' . $name);
                    $images->delete();
                }

                $files = $request->img_list;
                // duyệt từng ảnh và thực hiện lưu
                foreach ($request->img_list as $index => $file) {

                    $name = $file->getClientOriginalName();
                    $pathFull = 'uploads/' . date("Y-m-d");

                    $file->storeAs(
                        'public/' . $pathFull, $name
                    );

                    $thumb = '/storage/' . $pathFull . '/' . $name;
                     // Tạo đối tưọng HinhAnh
                     $images = new ProductImage();
                     $images->product_id = $product->id;
                     $images->image = $thumb;
                     $images->save();
                }

            }
            //loại sp thường
            if($request->input_type=='normal'){
                if($request->is_variation=='1'){
                // thêm thuộc tính khi chuyển loại sp
                        foreach($request->propertie_name_n as $value => $name){
                            // cắt mảng
                            $values = $request->propertie_value_n[$value];
                            $value = explode('|', $values);
                            foreach($value as $list => $listValue){
                                $properties_up = new Propertie();
                                $properties_up->propertie_name = $name;
                                $properties_up->propertie_slug = Str::slug($name);
                                $properties_up->propertie_value = $listValue;
                                $properties_up->product_id = $id;
                                $properties_up->save();
                            }
                        }
                }
            }
            //loại sp biến thể
           if($request->input_type=='variant'){
                if($request->is_variation=='1'){
                    // cập nhật lại thuộc tính cũ
                    if(isset($request->propertie_name)){
                        foreach($request->propertie_name as $index => $name){
                            $my_id = $request->id[$index];
                            $properties = Propertie::where('id', $my_id)->first();
                            $properties->propertie_name = $name;
                            $properties->propertie_slug = Str::slug($name);
                            $properties->propertie_value = $request->propertie_value[$index];
                            $properties->product_id = $id;
                            $properties->updated_at   = NOW();
                            $properties->save();

                    }
                    }
                    // thêm thuộc tính mới
                    if($request->input_propertie=='check'){
                        foreach($request->propertie_name_n as $value => $name){
                            // cắt mảng
                            $values = $request->propertie_value_n[$value];
                            $value = explode('|', $values);
                            foreach($value as $list => $listValue){
                                $properties_n = new Propertie;
                                $properties_n->propertie_name = $name;
                                $properties_n->propertie_slug = Str::slug($name);
                                $properties_n->propertie_value = $listValue;
                                $properties_n->product_id = $id;
                                $properties_n->save();
                            }

                        }
                    }
                }
           }

        return redirect('/product')->with('success', trans('alert.update.success'));

    }
    public function index(Request $request)
    {
        $data = Product::orderBy('id','desc')->paginate(15);
        if($search = $request->search){
           $data = Product::orderBy('id','desc')->where('product_name','like','%'.$search.'%')->paginate(20);
        }
        return view('pages.product.list',[
            'title'     => 'Danh sách sản phẩm',
            'data'      => $data
        ]);
    }
    public function createVariant($id)
    {
        $slug = Propertie::select('propertie_slug')->distinct('propertie_slug')->where('product_id', $id)->get();
        $count = count($slug);
        // $properties = [] ;
        $html = '';
        foreach($slug as $value){
            $properties= Propertie::where('propertie_slug', $value->propertie_slug)->where('product_id', $id)->get();
            $html.='<select class="form-control is_variation col-3" name="propertie_id[]">';
               foreach($properties as $propertie){
                $html.='<option value='.$propertie->id.'>'.$propertie->propertie_name.': '.$propertie->propertie_value.'</option>';
               }
            $html.='</select>';

        }
        return view('pages.variant.add',[
            'title' => 'Thêm biến thể sản phẩm',
            'html'  => $html,
            'id'    => $id,
            'count' => $count,
        ]);
    }
    public function storeVariant(Request $request)
    {
                    $arr = $request->propertie_id;
                    foreach($request->image as $index => $file){
                        $variant = new Variantion;
                        // lưu id link
                        $id_link = [];
                        $count = $request->count;
                        for($i=1;$i<$count;$i++){
                            $id_link[] = $arr[$i].' ';
                        }
                        $variant->propertie_id = $arr[0];
                        $variant->propertie_id_link = implode($id_link);
                        $variant->product_id = $request->product_id;
                        $variant->price = $request->price[$index];
                        // check ảnh sp
                        if ($request->hasFile('image')) {
                            $name = $file->getClientOriginalName();
                            $pathFull = 'uploads/' . date("Y-m-d");

                            $file->storeAs(
                                'public/' . $pathFull, $name
                            );

                            $thumb = '/storage/' . $pathFull . '/' . $name;
                            $variant->img = $thumb;
                        }

                    $variant->save();
                    $arr = array_slice($arr,$count);
                }
        return redirect('/product')->with('success', trans('alert.add.success'));

    }

    public function showVariant($id)
    {
        $i = 0;
        $variant = Variantion::where('product_id', $id)->get();
        $html = '';
        foreach($variant as $variant){
            // Vòng 1
            $html .= '<div class="card bg-gradient col-12" style="color:#111111;border-left-color: #6BB5D8;border-left-width: 4px;background-color:#f6f7f7">
                    <div class="card-header border-0 ui-sortable-handle" style="cursor: move;">
                        <div class="card-title row" style="display:flex;width:80%;">';
            $id_slug = $variant->propertie_id;
            $slug = Propertie::select('propertie_slug')->where('product_id', $id)->where('id', $id_slug)->first();
            $html .= '<select class="form-control is_variation col-3" name="propertie_id[]">';
            $propertie_first = Propertie::where('propertie_slug', $slug->propertie_slug)->where('product_id', $id)->get();
            foreach($propertie_first as $first){
                $html.='<option value='.$first->id.' ';
                if($first->id == $variant->propertie_id ){
                      $html .= 'selected' ;
                }
                $html .=  ' >'.$first->propertie_name.': '.$first->propertie_value.'</option>';
            }
            $html .='</select>';
            // echo $html;
            // Vòng 2
            $propertie_last = $variant->propertie_id_link;
            $arr_last = explode(' ', $propertie_last);
            $count = count($arr_last);
            $arr_search = array_search('', $arr_last);
            unset($arr_last[$arr_search]);
            foreach($arr_last as $index => $arr_last){
                $html .= '<select class="form-control is_variation col-3" name="propertie_id[]">';
                    $id_slug_last = $arr_last;
                    $slug_last = Propertie::select('propertie_slug')->where('product_id', $id)->where('id', $id_slug_last)->first();
                    if($slug_last != null){
                        $propertie_last = Propertie::where('propertie_slug', $slug_last->propertie_slug)->where('product_id', $id)->get();

                        foreach($propertie_last as $last){
                            $html.='<option value='.$last->id.' ';
                            if($arr_last == $last->id ){
                                $html .= 'selected' ;
                            }
                            $html .=  ' >'.$last->propertie_name.': '.$last->propertie_value.'</option>';
                        }
                    }
                $html .='</select>';

                }
                $html .=    '</div>
                            <div class="card-tools">
                                <button type="button" class="btn bg-dark btn-sm" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                <button type="button" class="btn bg-dark btn-sm removeVariant" data-url ="/product/deleteVariant/'.$variant->id.'"><i class="fas fa-times"></i></button>
                            </div>
                        </div>
                        <div class="card-body" style="display: block;">
                            <input type="hidden" name="my_id[]" value="'.$variant->id.'">
                            <input type="hidden" name="count" value="'.$count.'">
                            <div class="row pd-10">
                                <label class="col-3">Giá:</label>
                                <input type="text" name="price[]" value="'.$variant->price.'" class="col-7 form-control" id=""  placeholder="Giá sản phẩm">
                            </div>
                            <div class="row pd-10"><label class="col-3">Hình ảnh:</label>
                                <input type="hidden" value="'.$variant->img.'" name="image_last[]">
                                <input type="file" name="image[]" class="col-7 form-control" id="image" onchange="ImagesFileAsURL()">
                                <div class="col-3"></div>
                                <div class="col-7" id="displayImg">
                                    <img src="'.$variant->img.'">
                                </div>
                            </div>
                        </div>
                    </div>';
            }

        // html mới
        $slug_n = Propertie::select('propertie_slug')->distinct('propertie_slug')->where('product_id', $id)->get();
        $count_n = count($slug_n);
        // $properties = [] ;
        $html_n = '';
        foreach($slug_n as $value){
            $properties_n= Propertie::where('propertie_slug', $value->propertie_slug)->where('product_id', $id)->get();
            $html_n.='<select class="form-control is_variation col-3" name="propertie_id_n[]">';
               foreach($properties_n as $propertie){
                $html_n.='<option value='.$propertie->id.'>'.$propertie->propertie_name.': '.$propertie->propertie_value.'</option>';
               }
            $html_n.='</select>';

        }
        return view('pages.variant.update',[
            'title' => 'Cập nhật thuộc tính',
            'html_n'  => $html_n,
            'html'  => $html,
            'id'    => $id,
            'count' => $count_n,
        ]);
    }

    public function updateVariant(Request $request, $id)
    {
        // cập nhật biến thể cũ
        $arr = $request->propertie_id;
        foreach($request->price as $index => $file){
            $my_id = $request->my_id[$index];
            $variant = Variantion::where('id',$my_id)->first();
            // lưu id link
            $id_link = [];
            $count = $request->count;
            for($i=1;$i<$count;$i++){
                $id_link[] = $arr[$i].' ';
            }
            $variant->propertie_id = $arr[0];
            $variant->propertie_id_link = implode($id_link);
            $variant->product_id = $id;
            $variant->price = $file;
            // check ảnh sp
            $image = $request->image;
            if(isset($image[$index])){
                $name = $image[$index]->getClientOriginalName();
                $pathFull = 'uploads/' . date("Y-m-d");
                $image[$index]->storeAs(
                    'public/' . $pathFull, $name
                );

                $thumb = '/storage/' . $pathFull . '/' . $name;
                $variant->img = $thumb;
            }else{
                $variant->img = $request->image_last[$index];
            }
                $variant->save();
                $arr = array_slice($arr,$count);
        }
        // thêm biến thể mới
            if($request->input_variant == 'check'){
                $arr_n = $request->propertie_id_n;
                    foreach($request->image_n as $index => $file){
                        $variant_n = new Variantion;
                        // lưu id link
                        $id_link_n = [];
                        $count_n = $request->count_n;
                        for($i=1;$i<$count_n;$i++){
                            $id_link_n[] = $arr_n[$i].' ';
                        }
                        $variant_n->propertie_id = $arr_n[0];
                        $variant_n->propertie_id_link = implode($id_link_n);
                        $variant_n->product_id = $request->id;
                        $variant_n->price = $request->price_n[$index];

                        // check ảnh sp
                        if ($request->hasFile('image_n')) {
                                $name = $file->getClientOriginalName();
                                $pathFull = 'uploads/' . date("Y-m-d");
                                $file->storeAs(
                                    'public/' . $pathFull, $name
                                );

                                $thumb = '/storage/' . $pathFull . '/' . $name;
                                $variant_n->img = $thumb;
                                }
                        $variant_n->save();
                        $arr_n = array_slice($arr_n,$count_n);
                    }
            }
        return redirect('/product')->with('success', trans('alert.update.success'));
    }
    // xóa sản phẩm
    public function delete($id)
    {
            $product = Product::where('id', $id)->first();
            $configuration  = Configuration::where('product_id', $id)->first();
            $image = ProductImage::where('product_id', $id)->get();
            $propertie = Propertie::where('product_id', $id)->get();
            $variant = Variantion::where('product_id', $id)->get();
            if($configuration != null){
                $configuration->delete();
            }
            if(empty($image)){
                 // DELETE các dòng liên quan trong table `product image`
                foreach ($image as $list) {
                    // Xóa hình cũ để tránh rác
                    $nameimg = substr(($list->image),28);
                    Storage::delete('public/uploads/'.$list->image.'/' . $nameimg);
                    // Xóa record
                    $list->delete();
                    $image->delete();
            }
            if(!empty($propertie)){
                foreach ($propertie as $propertie){
                    $propertie->delete();
                }
            }
            if(!empty($variant)){
                foreach ($variant as $variant){
                    $variant->delete();
                }
            }
            $product->delete();
            return redirect('/product')->with('success', trans('alert.update.success'));
            }
    }

    // xóa thuộc tính
    public function deletePropertie($id, $product_id)
    {
        $propertie = Propertie::where('id',$id)->first();
        if($propertie){
            $variant = Variantion::where('product_id', $product_id)->get();
            if($variant){
                foreach($variant as $variant){

                    // xóa propertie id
                    if($variant->propertie_id == $id){
                        $variant->delete();
                    }

                    // xóa propertie id link
                    $propertie_id_link = $variant->propertie_id_link;
                    $propertie_id = explode(' ', $propertie_id_link);
                    foreach($propertie_id as $propertie_id){
                        if($propertie_id == $id){
                            $variant->delete();
                        }
                    }

                }
            }
            $propertie->delete();
        }

    }

    // xóa biến thể
    public function deleteVariant($id)
    {
            $variant = Variantion::find($id);
            $variant->delete();
    }
}


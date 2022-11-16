<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductCategories;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
class CategoriesProductController extends Controller

{
    public function getAdd()
    {
        $product_categories= DB::table('product_categories')->where('parent_id', 0)->get();
        return view('pages.categoriesproduct.add',[
            'product_categories' => $product_categories,
        ]);
    }
    public function postAdd(Request $request)
    {
        $data = array();
        $data['category_name'] = $request->category_name;
        $data['category_slug'] = $request->category_slug;
        $data['category_image'] = $request->category_image;
        $data['category_order'] = $request->category_order;
        $data['parent_id'] = $request->parent_id;
        if($request->category_display=='on'){
            $data['category_display']=1;
        }else{
            $data['category_display']=0;
        }
        //$data['supplier_display'] = $request->supplier_display;
        if($request->category_outstanding=='on'){
            $data['category_outstanding']=1;
        }else{
            $data['category_outstanding']=0;
        }
      //  $data['supplier_outstanding'] = $request->supplier_outstanding;
        $data['category_desc'] = $request->category_desc;
        $data['category_content'] = $request->category_content;
        $data['seo_title'] = $request->seo_title;
        $data['seo_keywords'] = $request->seo_keywords;
        $data['seo_description'] = $request->seo_description;
        $data['created_at'] = NOW();
print_r($data);
        DB::table('product_categories')->insert($data);
        return Redirect::to('CategoriesProduct/List');
    }
    public function getUpdate($id)
    {
        $product_categories= DB::table('product_categories')->where('parent_id', 0)->get();
        $parent_id=DB::table('product_categories')->where('id',$id)->get();
        

        foreach($parent_id as $parent_id) {
            $parent_id_val = $parent_id -> parent_id;
        }
           $updateCP= DB::table('product_categories')->where('id', $id)->get();
            // echo $updateCP;
            // exit;
        if($parent_id_val !=0) {
            $parent_name=DB::table('product_categories')->where('id',$parent_id_val)->get();
            foreach($parent_name as $parent_name) {
                $parent_name_val = $parent_name -> category_name;
            //echo $parent_name_val;
    
            }
            
            return view('pages.categoriesproduct.edit',[
            'updateCP' => $updateCP,
            'parent_name_val'=>$parent_name_val,
            'product_categories' =>$product_categories,
            'parent_id_val' =>$parent_id_val
        ]);
        } else {
            return view('pages.categoriesproduct.edit',[
                'updateCP' => $updateCP,
                'product_categories' =>$product_categories,
                'parent_id_val' =>$parent_id_val
            ]);
        }
        
    }
    public function postUpdate(Request $request, $id)
    {
        $product_categories = ProductCategories::find($id);
        $product_categories->category_name = $request->category_name;
       $product_categories->category_slug = $request->category_slug;
       $product_categories->category_image = $request->category_image;
       $product_categories->category_order = $request->category_order;
       $product_categories->parent_id = $request->parent_id;
       if($request->supplier_display=='on'){
        $product_categories->category_display = 1;
    }else{
        $product_categories->category_display = 0;
    }
    //$data['supplier_display'] = $request->supplier_display;
    if($request->supplier_display=='on'){
        $product_categories->category_outstanding = 1;
    }else{
        $product_categories->category_outstanding = 0;
    }
    $product_categories->category_desc = $request->category_desc;
    $product_categories->category_content = $request->category_content;
       $product_categories->seo_title = $request->seo_title;
       $product_categories->seo_keywords = $request->seo_keywords;
       $product_categories->seo_description = $request->seo_description;
       $product_categories->created_at = NOW();
       $product_categories->save();
       return redirect('CategoriesProduct/List')->with('thongbao','Sửa thành công');
    }
    public function getList()
    {
        $product_categories = DB::table('product_categories')->get();
        return view('pages.categoriesproduct.list',[
            'product_categories' => $product_categories,
        ]);
    }
    public function getDelete($id)
    {
        DB::table('product_categories')->where('id', $id)->delete();
       return Redirect::to('CategoriesProduct/List')->with('thongbao','Xóa thành công');
    }
}

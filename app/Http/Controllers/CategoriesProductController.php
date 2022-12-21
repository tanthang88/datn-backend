<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoriesProduct\AddCategoriesProductRequest;
use App\Http\Requests\CategoriesProduct\UpdateCategoriesProductRequest;
use Illuminate\Http\Request;
use App\Models\ProductCategories;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
class CategoriesProductController extends Controller

{
    public function create()
    {
        $product_categories= DB::table('product_categories')->where('parent_id', 0)->get();
        return view('pages.categoriesproduct.add',[
            'title' => 'Thêm mới danh mục',
            'product_categories' => $product_categories,
        ]);
    }
    public function store(AddCategoriesProductRequest $request)
    {
        $data = array();
        $data['category_name'] = $request->category_name;
        $data['category_slug'] = Str::slug($request->category_name);
        if($request->hasFile('category_image')){
            $name = $request->file('category_image')->getClientOriginalName();
            $pathFull = 'uploads/' . date("Y-m-d");

            $request->file('category_image')->storeAs(
                'public/' . $pathFull, $name
            );

            $thumb = '/storage/' . $pathFull . '/' . $name;
            $data['category_image'] = $thumb;
        }
        $data['category_order'] = 1;
        $data['parent_id'] = $request->parent_id;
        if($request->category_display=='on'){
            $data['category_display']=1;
        }else{
            $data['category_display']=0;
        }
        if($request->category_outstanding=='on'){
            $data['category_outstanding']=1;
        }else{
            $data['category_outstanding']=0;
        }
        $data['category_desc'] = $request->category_desc;
        $data['category_content'] = $request->category_content;
        $data['seo_title'] = $request->seo_title;
        $data['seo_keywords'] = $request->seo_keywords;
        $data['seo_description'] = $request->seo_description;
        $data['created_at'] = NOW();
        DB::table('product_categories')->insert($data);
        return Redirect::to('categoriesProduct/')->with('success', trans('alert.add.success'));
    }
    public function show($id)
    {
        $product_categories= DB::table('product_categories')->where('parent_id', 0)->get();
        $parent_id=DB::table('product_categories')->where('id',$id)->get();


        foreach($parent_id as $parent_id) {
            $parent_id_val = $parent_id -> parent_id;
        }
           $updateCP= DB::table('product_categories')->where('id', $id)->first();
        if($parent_id_val !=0) {
            $parent_name=DB::table('product_categories')->where('id',$parent_id_val)->get();
            foreach($parent_name as $parent_name) {
                $parent_name_val = $parent_name -> category_name;
            }

            return view('pages.categoriesproduct.edit',[
                'title' => 'Chỉnh sửa danh mục',
                'updateCP' => $updateCP,
                'parent_name_val'=>$parent_name_val,
                'product_categories' =>$product_categories,
                'parent_id_val' =>$parent_id_val
        ]);
        } else {
            return view('pages.categoriesproduct.edit',[
                'title' => 'Chỉnh sửa danh mục',
                'updateCP' => $updateCP,
                'product_categories' =>$product_categories,
                'parent_id_val' =>$parent_id_val
            ]);
        }

    }
    public function update(UpdateCategoriesProductRequest $request, $id)
    {
       $product_categories = ProductCategories::find($id);
       $product_categories->category_name = $request->category_name;
       $product_categories->category_slug = Str::slug($request->category_name);
       if($request->hasFile('category_image')){
            $name = $request->file('category_image')->getClientOriginalName();
            $pathFull = 'uploads/' . date("Y-m-d");

            $request->file('category_image')->storeAs(
                'public/' . $pathFull, $name
            );

            $thumb = '/storage/' . $pathFull . '/' . $name;
            $product_categories->category_image = $thumb;
       }
       $product_categories->category_order = 1;
       $product_categories->parent_id = $request->parent_id;
       if($request->category_display=='on'){
            $product_categories->category_display = 1;
        }else{
            $product_categories->category_display = 0;
        }
        if($request->category_display=='on'){
            $product_categories->category_outstanding = 1;
        }else{
            $product_categories->category_outstanding = 0;
        }
      $product_categories->category_desc = $request->category_desc;
      $product_categories->category_content = $request->category_content;
      $product_categories->seo_title = $request->seo_title;
      $product_categories->seo_keywords = $request->seo_keywords;
      $product_categories->seo_description = $request->seo_description;
       $product_categories->save();
       return redirect('/categoriesProduct')->with('success', trans('alert.update.success'));
    }
    public function index(Request $request)
    {
        $product_categories = DB::table('product_categories')->orderBy('id','desc')->get();
        if($search = $request->search){
            $product_categories = DB::table('product_categories')->where('category_name','like','%'.$search.'%')->orderBy('id','desc')->get();
         }
        return view('pages.categoriesproduct.list',[
            'title' => 'Danh sách danh mục sản phẩm',
            'product_categories' => $product_categories,
        ]);
    }
    public function delete($id)
    {
        DB::table('product_categories')->where('id', $id)->delete();
    }
}

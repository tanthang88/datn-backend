<?php

namespace App\Http\Controllers;

use App\Models\PostCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class PostCategoriesController extends Controller
{
    public function getAdd()
    {

        return view('pages.PostCategories.add');
    }
    public function postAdd(Request $request)
    {
        $data = array();
        $data['category_name'] = $request->category_name;
        $data['category_slug'] = changeTitle($request->category_name);
        $data['category_order'] = $request->category_order;
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
        $data['type'] = changeTitle($request->type);
        $data['category_content'] = $request->category_content;
        $data['category_title'] = $request->category_title;
        $data['seo_keyword'] = $request->seo_keyword;
        $data['seo_description'] = $request->seo_description;
        $data['created_at'] = NOW();
print_r($data);
        DB::table('post_categories')->insert($data);
        Session::put('message','Thêm thành công');
        return Redirect::to('PostCategories/List');
    }

    public function getUpdate($id)
    {
       $updateCPost= DB::table('post_categories')->where('id', $id)->first();
       return view('pages.PostCategories.edit',[
        'updateCPost' => $updateCPost,
    ]);
    }
    public function postUpdate(Request $request, $id)
    {
        $post_categories = PostCategory::find($id);
        $post_categories->category_name = $request->category_name;
        $post_categories->category_slug = changeTitle($request->category_name);
       $post_categories->category_order = $request->category_order;
       if($request->category_display=='on'){
        $post_categories->category_display = 1;
    }else{
        $post_categories->category_display = 0;
    }
    //$data['supplier_display'] = $request->supplier_display;
    if($request->category_outstanding=='on'){
        $post_categories->category_outstanding = 1;
    }else{
        $post_categories->category_outstanding = 0;
    }
    $post_categories->category_desc = $request->category_desc;
    $post_categories->category_content = $request->category_content;
    $post_categories->type = changeTitle($request->type);
    $post_categories->category_title = $request->category_title;
    $post_categories->seo_keyword = $request->seo_keyword;
    $post_categories->seo_description = $request->seo_description;
    $post_categories->created_at = NOW();
    $post_categories->save();
        Session::put('message','Sửa thành công');
       return redirect('PostCategories/List');

    }
    public function getList()
    {
        $post_categories = DB::table('post_categories')->get();
        return view('pages.PostCategories.list',[
            'post_categories' => $post_categories,
        ]);
    }
    public function getDelete($id)
    {
       DB::table('post_categories')->where('id', $id)->delete();
       Session::put('message','Xóa thành công');
       return Redirect::to('PostCategories/List');
          }
}

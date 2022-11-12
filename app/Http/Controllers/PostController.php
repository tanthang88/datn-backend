<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function getAdd()
    {
        $post_categories = DB::table('post_categories')->get();
        return view('pages.Post.add',[
            'post_categories' => $post_categories,
        ]);
        
    }
    public function postAdd(Request $request)
    {
        $data = array();
        $data['category_id'] = $request->category_id;
        $data['post_name'] = $request->post_name;
        $data['post_slug'] = changeTitle($request->post_name);
      
        if($request->hasFile('post_img')){
            $name = $request->file('post_img')->getClientOriginalName();
            $pathFull = 'uploads/' . date("Y-m-d");
    
            $request->file('post_img')->storeAs(
                'public/' . $pathFull, $name
            );
    
            $thumb = '/storage/' . $pathFull . '/' . $name;
            //dd($thumb);
            $data['post_img'] = $thumb;
        }


        if($request->post_display=='on'){
            $data['post_display']=1;
        }else{
            $data['post_display']=0;
        }
        //$data['supplier_display'] = $request->supplier_display;
        if($request->post_outstanding=='on'){
            $data['post_outstanding']=1;
        }else{
            $data['post_outstanding']=0;
        }
      //  $data['supplier_outstanding'] = $request->supplier_outstanding;
        $data['post_desc'] = $request->post_desc;
        $data['type'] = changeTitle($request->type);
        $data['post_content'] = $request->content;
        $data['post_seo_title'] = $request->post_seo_title;
        $data['post_seo_keyword'] = $request->post_seo_keyword;
        $data['post_seo_description'] = $request->post_seo_description;
        $data['created_at'] = NOW();
// print_r($data);
        DB::table('posts')->insert($data);
        Session::put('message','Thêm thành công');
        return Redirect::to('Post/List');
    }

    public function getUpdate($id)
    {
      $post_categories = DB::table('post_categories')->get();
      $posts = DB::table('posts')->where('id',$id)->first();
      $category_id = DB::table('posts')->where('id',$id)->first();
      $category_id =  $category_id->category_id;
      $category_name = DB::table('post_categories')->where('id',$category_id)->first();
      $category_name =  $category_name->category_name;
      
      return view('pages.Post.edit',[
        'category_name' => $category_name,
        'post_categories' => $post_categories,
        'posts' => $posts,
        'category_id' => $category_id,


    ]);
    }
    public function postUpdate(Request $request, $id)
    {
        $posts = Post::find($id);
        $posts->category_id =$request->category_id;
        $posts->post_name = $request->post_name;
        $posts->post_slug = changeTitle($request->post_name);
       $posts->post_order = $request->post_order;

       if($request->hasFile('post_img')){
        $name = $request->file('post_img')->getClientOriginalName();
        $pathFull = 'uploads/' . date("Y-m-d");

        $request->file('post_img')->storeAs(
            'public/' . $pathFull, $name
        );

        $thumb = '/storage/' . $pathFull . '/' . $name;
        // dd($thumb);
        $posts->post_img = $thumb;
        // dd($data['post_img']);
    }
       if($request->post_display=='on'){
        $posts->post_display = 1;
    }else{
        $posts->post_display = 0;
    }
    //$data['supplier_display'] = $request->supplier_display;
    if($request->post_outstanding=='on'){
        $posts->post_outstanding = 1;
    }else{
        $posts->post_outstanding = 0;
    }
    $posts->post_desc = $request->post_desc;
    $posts->post_content = $request->content;
    $posts->type = changeTitle($request->type);
    $posts->post_seo_title = $request->post_seo_title;
    $posts->post_seo_keyword = $request->post_seo_keyword;
    $posts->post_seo_description = $request->post_seo_description;
    $posts->created_at = NOW(); 
    $posts->save();
        Session::put('message','Sửa thành công');
       return redirect('Post/List');
       
    }
    public function getList()
    {
        $posts = DB::table('posts')->get();
        return view('pages.Post.list',[
            'posts' => $posts,
        ]);
    }
    public function getDelete($id)
    {
       DB::table('posts')->where('id', $id)->delete();
       Session::put('message','Xóa thành công');
       return Redirect::to('Post/List');
          }
}

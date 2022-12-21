<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoriesPost\AddCategoriesPostRequest;
use App\Http\Requests\CategoriesPost\UpdateCategoriesPostRequest;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class PostCategoriesController extends Controller
{
    public function create()
    {
        return view('pages.postcategories.add',[
            'title' => 'Thêm mới danh mục bài viết'
        ]);
    }
    public function store(AddCategoriesPostRequest $request)
    {
        $data = array();
        $data['category_name'] = $request->category_name;
        $data['category_slug'] = changeTitle($request->category_name);
        $data['category_order'] = 1;
        if ($request->category_display == 'on') {
            $data['category_display'] = 1;
        } else {
            $data['category_display'] = 0;
        }
        if ($request->category_outstanding == 'on') {
            $data['category_outstanding'] = 1;
        } else {
            $data['category_outstanding'] = 0;
        }
        $data['category_desc'] = $request->category_desc;
        $data['category_content'] = $request->category_content;
        $data['type'] = '';
        $data['category_title'] = $request->category_title;
        $data['seo_keyword'] = $request->seo_keyword;
        $data['seo_description'] = $request->seo_description;
        $data['created_at'] = NOW();
        DB::table('post_categories')->insert($data);
        return Redirect::to('postCategories/')->with('success', trans('alert.add.success'));
    }

    public function show($id)
    {
        $updateCPost = DB::table('post_categories')->where('id', $id)->first();
        return view('pages.postcategories.edit', [
            'title' => 'Chỉnh sửa danh mục bài viết',
            'updateCPost' => $updateCPost,
        ]);
    }
    public function update(UpdateCategoriesPostRequest $request, $id)
    {
        $post_categories = PostCategory::find($id);
        $post_categories->category_name = $request->category_name;
        $post_categories->category_slug = changeTitle($request->category_name);
        $post_categories->category_order = 1;
        if ($request->category_display == 'on') {
            $post_categories->category_display = 1;
        } else {
            $post_categories->category_display = 0;
        }
        if ($request->category_outstanding == 'on') {
            $post_categories->category_outstanding = 1;
        } else {
            $post_categories->category_outstanding = 0;
        }
        $post_categories->type = '';
        $post_categories->category_desc = $request->category_desc;
        $post_categories->category_content = $request->category_content;
        $post_categories->category_title = $request->category_title;
        $post_categories->seo_keyword = $request->seo_keyword;
        $post_categories->seo_description = $request->seo_description;
        $post_categories->created_at = NOW();
        $post_categories->save();
        return Redirect::to('postCategories/')->with('success', trans('alert.update.success'));
    }
    public function index(Request $request)
    {
        $post_categories = DB::table('post_categories')->orderBy('id','desc')->paginate(15);
        if ($search = $request->search) {
            $post_categories = DB::table('post_categories')->orderBy('id','desc')->where('category_name', 'like', '%' . $search . '%')->paginate(15);
        }
        return view('pages.postcategories.list', [
            'title' => 'Danh sách danh mục bài viết',
            'post_categories' => $post_categories,
        ]);
    }
    public function delete($id)
    {
        DB::table('post_categories')->where('id', $id)->delete();
    }
}

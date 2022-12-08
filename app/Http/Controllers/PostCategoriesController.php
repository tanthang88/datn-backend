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
    public function create()
    {
        return view('pages.postcategories.add');
    }
    public function store(Request $request)
    {
        $data = array();
        $data['category_name'] = $request->category_name;
        $data['category_slug'] = changeTitle($request->category_name);
        $data['category_order'] = $request->category_order;
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
            'updateCPost' => $updateCPost,
        ]);
    }
    public function update(Request $request, $id)
    {
        $post_categories = PostCategory::find($id);
        $post_categories->category_name = $request->category_name;
        $post_categories->category_slug = changeTitle($request->category_name);
        $post_categories->category_order = $request->category_order;
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
        $post_categories = DB::table('post_categories')->get();
        if ($search = $request->search) {
            $post_categories = DB::table('post_categories')->where('category_name', 'like', '%' . $search . '%')->get();
        }
        return view('pages.postcategories.list', [
            'post_categories' => $post_categories,
        ]);
    }
    public function delete($id)
    {
        DB::table('post_categories')->where('id', $id)->delete();
    }
}

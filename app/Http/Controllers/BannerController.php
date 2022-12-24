<?php
namespace App\Http\Controllers;

use App\Http\Requests\Banner\AddBannerRequest;
use App\Http\Requests\Banner\UpdateBannerRequest;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class BannerController extends Controller
{
    public function create()
    {
        return view('pages.banner.add', [
            'title' => 'Thêm mới banner',
        ]);
    }
    public function store(AddBannerRequest $request)
    {
        $data = array();
        $data['title'] = $request->title;

        if ($request->hasFile('image')) {
            $name = $request->file('image')->getClientOriginalName();
            $pathFull = 'uploads/' . date("Y-m-d");

            $request->file('image')->storeAs(
                'public/' . $pathFull, $name
            );

            $thumb = '/storage/' . $pathFull . '/' . $name;
            $data['image'] = $thumb;
        }

        $data['link'] = $request->link;
        $data['type'] = changeTitle($request->type);
        if ($request->display == 'on') {
            $data['display'] = 1;
        } else {
            $data['display'] = 0;
        }
        DB::table('banners')->insert($data);
        return redirect('/banner')->with('success', trans('alert.add.success'));
    }
    public function show(Banner $banner)
    {
        return view('pages.banner.edit', [
            'title' => 'Chỉnh sửa banner',
            'banner' => $banner,
        ]);
    }
    public function update(UpdateBannerRequest $request, $id)
    {
        $banners = Banner::find($id);
        $banners->title = $request->title;
        if ($request->hasFile('image')) {
            $name = $request->file('image')->getClientOriginalName();
            $pathFull = 'uploads/' . date("Y-m-d");

            $request->file('image')->storeAs(
                'public/' . $pathFull, $name
            );

            $thumb = '/storage/' . $pathFull . '/' . $name;
            $banners->image = $thumb;
        }
        $banners->link = $request->link;
        $banners->type = changeTitle($request->type);
        if ($request->display == 'on') {
            $banners->display = 1;
        } else {
            $banners->display = 0;
        }

        $banners->save();
        return redirect('/banner')->with('success', trans('alert.update.success'));

    }
    public function index(Request $request)
    {
        $banners = DB::table('banners')->orderByDesc('id')->paginate(config('define.pagination.per_page'));
        if ($search = $request->search) {
            $banners = Banner::orderBy('id', 'desc')->where('title', 'like', '%' . $search . '%')->paginate(config('define.pagination.per_page'));
        }
        return view('pages.banner.list', [
            'title' => 'Danh sách banner',
            'banners' => $banners,
        ]);
    }
    public function delete($id)
    {
        DB::table('banners')->where('id', $id)->delete();
    }
}

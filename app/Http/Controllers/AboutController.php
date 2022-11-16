<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\About;
use App\Http\Requests\AboutRequest;

class AboutController extends Controller
{
    public function getAdd()
    {
        return view('pages.about.add',[
            'title'      => 'Thêm mới thông tin',
        ]);
    }

    public function postAdd(AboutRequest $request)
    {
            $about = new About;
            $about->about_name = $request->about_name;
            $about->about_slug = Str::slug($request->about_name);
            $about->type = $request->type;
            $about->about_order = $request->about_order;
            if($request->about_display =='on'){
                $about->about_display = 1;
            }else{
                $about->about_display = 0;

            }
            $about->about_desc = $request->about_desc;
            $about->about_content = $request->about_content;
            $about->seo_title = $request->seo_title;
            $about->seo_keyword = $request->seo_keyword;
            $about->seo_description = $request->seo_description;
            $about->save();

        return redirect('/about/list')->with('success', trans('alert.update.success'));
    }

    public function getUpdate($id)
    {
        $about = About::where('id', $id)->first();
        return view('pages.about.update',[
            'title' => 'Cập nhật thông tin',
            'about' => $about,
        ]);
    }

    public function postUpdate(AboutRequest $request, $id)
    {
            $about = About::find($id);
            $about->about_name = $request->about_name;
            $about->about_slug = Str::slug($request->about_name);
            $about->type = $request->type;
            $about->about_order = $request->about_order;
            if($request->about_display =='on'){
                $about->about_display = 1;
            }else{
                $about->about_display = 0;

            }
            $about->about_desc = $request->about_desc;
            $about->about_content = $request->about_content;
            $about->seo_title = $request->seo_title;
            $about->seo_keyword = $request->seo_keyword;
            $about->seo_description = $request->seo_description;
            $about->save();

            return redirect('/about/list')->with('success', trans('alert.update.success'));

    }

    public function getList(Request $request)
    {
        $data = About::orderBy('id','desc')->paginate(20);
        if($search = $request->search){
            $data = About::orderBy('id','desc')->where('about_name','like','%'.$search.'%')->paginate(20);
         }
        return view('pages.about.list',[
            'title'     => 'Danh sách thông tin',
            'data'      => $data
        ]);
    }

    public function delete($id)
    {
            $about = About::where('id', $id)->first();
            if($about){
                $about->delete();
            }
            return redirect('/about/list')->with('success', trans('alert.update.success'));
    }
}

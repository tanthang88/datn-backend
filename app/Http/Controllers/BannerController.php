<?php
namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class BannerController extends Controller
{
    public function getAdd()
    {

        return view('pages.banner.add');
    }
    public function postAdd(Request $request)
    {
        $data = array();
        $data['title'] = $request->title;
       
        if($request->hasFile('image')){
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
        if($request->display=='on'){
            $data['display']=1;
        }else{
            $data['display']=0;
        }
        DB::table('banners')->insert($data);
        Session::put('message','Thêm thành công');
        return Redirect::to('Banner/List');
    }
    public function getUpdate(Banner $banner)
    {
       return view('pages.banner.edit',[
        'banner' => $banner,
    ]);
    }
        public function postUpdate(Request $request, $id)
        {
        $banners = Banner::find($id);
        $banners->title = $request->title;
      
        if($request->hasFile('image')){
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
        if($request->display=='on'){
            $banners->display = 1;
        }else{
            $banners->display = 0;
        }

        $banners->save();
        Session::put('message','Cập nhật thành công');
        return redirect('Banner/List');
        }
        public function getList()
        {
            $banners = DB::table('banners')->get();
            return view('pages.banner/List',[
                'banners' => $banners,
            ]);
        }
        public function getDelete($id)
        {
        DB::table('banners')->where('id', $id)->delete();
        Session::put('message','Xóa thành công');
        return Redirect::to('Banner/List');
            }
}

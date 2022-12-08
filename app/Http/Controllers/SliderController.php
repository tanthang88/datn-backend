<?php
namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class SliderController extends Controller
{
    //
    
    public function getAdd()
    {

        return view('pages.slider.add');
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
            //dd($thumb);
            $data['image'] = $thumb;
        }

        $data['link'] = $request->link;
        $data['type'] = changeTitle($request->type);
        $data['desc'] = $request->desc;
        $data['content'] = $request->content;
        if($request->display=='on'){
            $data['display']=1;
        }else{
            $data['display']=0;
        }
        $data['order'] = $request->order;
        DB::table('sliders')->insert($data);
        Session::put('message','Thêm thành công');
        return Redirect::to('Slider/List');
    }
    public function getUpdate(Slider $slider)
    {
       return view('pages.slider.edit',[
        'slider' => $slider,
    ]);
    }
        public function postUpdate(Request $request, $id)
        {
        $sliders = Slider::find($id);
        $sliders->title = $request->title;
      
        if($request->hasFile('image')){
            $name = $request->file('image')->getClientOriginalName();
            $pathFull = 'uploads/' . date("Y-m-d");
    
            $request->file('image')->storeAs(
                'public/' . $pathFull, $name
            );
    
            $thumb = '/storage/' . $pathFull . '/' . $name;
            $sliders->image = $thumb;
        }

        $sliders->link = $request->link;
        $sliders->type = changeTitle($request->type);
        $sliders->desc = $request->desc;
        $sliders->content = $request->content;

        if($request->display=='on'){
            $sliders->display = 1;
        }else{
            $sliders->display = 0;
        }

        $sliders->order = $request->order;        
        $sliders->save();
        Session::put('message','Cập nhật thành công');
        return redirect('Slider/List');
        }
        public function getList()
        {
            $sliders = DB::table('sliders')->get();
            return view('pages.slider.list',[
                'sliders' => $sliders,
            ]);
        }
        public function getDelete($id)
        {
        DB::table('sliders')->where('id', $id)->delete();
        Session::put('message','Xóa thành công');
        return Redirect::to('Slider/List');
            }
}

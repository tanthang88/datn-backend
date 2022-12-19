<?php
namespace App\Http\Controllers;

use App\Http\Requests\Slider\AddSliderRequest;
use App\Http\Requests\Slider\UpdateSliderRequest;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class SliderController extends Controller
{
    //

    public function create()
    {
        return view('pages.slider.add',[
            'title' => 'Thêm mới slider',
        ]);
    }
    public function store(AddSliderRequest $request)
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
        $data['desc'] = $request->desc;
        $data['content'] = $request->content;
        if($request->display=='on'){
            $data['display']=1;
        }else{
            $data['display']=0;
        }
        $data['order'] = 1;
        DB::table('sliders')->insert($data);
        return redirect('slider/')->with('success', trans('alert.add.success'));
    }
    public function show(Slider $slider)
    {
       return view('pages.slider.edit',[
        'title' => 'Chỉnh sửa slider',
        'slider' => $slider,
    ]);
    }
        public function update(UpdateSliderRequest $request, $id)
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

            $sliders->order = 1;
            $sliders->save();
            return redirect('slider/')->with('success', trans('alert.update.success'));
        }
        public function index(Request $request)
        {
            $sliders = DB::table('sliders')->orderBy('id', 'desc')->paginate(15);
            if ($search = $request->search) {
                $sliders = Slider::orderBy('id', 'desc')->where('title', 'like', '%' . $search . '%')->paginate(15);
            }
            return view('pages.slider.list',[
                'title' => 'Danh sách slider',
                'sliders' => $sliders,
            ]);
        }
        public function delete($id)
        {
             DB::table('sliders')->where('id', $id)->delete();
        }
}

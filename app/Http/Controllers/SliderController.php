<?php

namespace App\Http\Controllers;

use App\Http\Requests\Slider\AddSliderRequest;
use App\Http\Requests\Slider\UpdateSliderRequest;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Traits\storageImageTrait;

class SliderController extends Controller
{
    use storageImageTrait;

    /**
     * create
     *
     * @return void
     */
    public function create()
    {
        return view('pages.slider.add', [
            'title' => 'Thêm mới slider',
            'slider_type' => config('define.slider.slider_type')
        ]);
    }

    /**
     * store
     *
     * @param  AddSliderRequest $request
     * @return void
     */
    public function store(AddSliderRequest $request)
    {
        $data = array();
        $data['title'] = $request->title;
        $dataUploadFeatureImage = $this->storageTraitUpload($request, 'image', 'slider_img');
        if (!empty($dataUploadFeatureImage)) {
            $data['image'] = $dataUploadFeatureImage['file_path'];
        }

        $data['link'] = $request->link;
        $data['type'] = $request->type;
        $data['desc'] = $request->desc;
        $data['content'] = $request->content;
        $request->display == 'on' ? $data['display'] = 1 : $data['display'] = 0;
        $data['order'] = 1;
        DB::table('sliders')->insert($data);
        return redirect('slider/')->with('success', trans('alert.add.success'));
    }

    /**
     * show
     *
     * @param  Slider $slider
     * @return void
     */
    public function show(Slider $slider)
    {
        return view('pages.slider.edit', [
            'title' => 'Chỉnh sửa slider',
            'slider' => $slider,
            'slider_type' => config('define.slider.slider_type')
        ]);
    }

    /**
     * update
     *
     * @param  UpdateSliderRequest $request
     * @param  mixed $id
     * @return void
     */
    public function update(UpdateSliderRequest $request, $id)
    {
        $sliders = Slider::find($id);
        $sliders->title = $request->title;
        $dataUploadFeatureImage = $this->storageTraitUpload($request, 'image', 'slider_img');
        if (!empty($dataUploadFeatureImage)) {
            $sliders->image = $dataUploadFeatureImage['file_path'];
        }

        $sliders->link = $request->link;
        $sliders->type = $request->type;
        $sliders->desc = $request->desc;
        $sliders->content = $request->content;
        $request->display == 'on' ? $sliders->display = 1 : $sliders->display = 0;
        $sliders->order = 1;
        $sliders->save();
        return redirect('slider/')->with('success', trans('alert.update.success'));
    }

    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $sliders = DB::table('sliders')->orderBy('id', 'desc')->paginate(config('define.pagination.per_page'));
        return view('pages.slider.list', [
            'title' => 'Danh sách slider',
            'sliders' => $sliders,
            'slider_type' => config('define.slider.slider_type'),
        ]);
    }

    /**
     * delete
     *
     * @param  mixed $id
     * @return void
     */
    public function delete($id)
    {
        return DB::table('sliders')->where('id', $id)->delete();
    }
}

<?php

namespace App\Services;

use App\Models\Slider;
use Illuminate\Http\Request;

class SliderService
{
    //getListSlider
    public function getListSlider()
    {
            return Slider::where('display',1)->get();
    }
    //getListSliderByType
    public function getListSliderByType(Request $request, $select = ['*'])
    {
        return Slider::select($select)
            ->where('type', $request->type)
            ->where('display',1)
            ->orderBy('id', 'DESC')
            ->get();

    }
}

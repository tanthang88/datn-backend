<?php

namespace App\Services;

use App\Models\Slider;
use Illuminate\Http\Request;

class SliderService
{
    //getListSlider
    public function getListSlider()
    {
        return Slider::all();
    }
    //getListSliderByType
    public function getListSliderByType(Request $request, $select = ['*'])
    {
        return Slider::select($select)
            ->where('type', $request->type)
            ->orderBy('id', 'DESC')
            ->get();

    }
}

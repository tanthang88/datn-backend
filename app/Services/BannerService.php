<?php

namespace App\Services;

use App\Models\Banner;
use Illuminate\Http\Request;

class BannerService
{
     //getListBanner
     public function getListBanner()
     {
         return Banner::all();
     }
    //getListBannerByType
    public function getListBannerByType(Request $request, $select = ['*'])
    {
        return Banner::select($select)
            ->where('type', $request->type)
            ->orderBy('id', 'DESC')
            ->get();
    }
}

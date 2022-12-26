<?php

namespace App\Services;

use App\Models\Banner;
use Illuminate\Http\Request;

class BannerService
{
     //getListBanner
     public function getListBanner()
     {
         return Banner::where('display',1)->get();
     }
    //getListBannerByType
    public function getListBannerByType(Request $request, $select = ['*'])
    {
        return Banner::select($select)
            ->where('type', $request->type)
            ->where('display',1)
            ->orderBy('id', 'DESC')
            ->get();
    }
}

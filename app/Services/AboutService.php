<?php

namespace App\Services;

use App\Models\About;
use Illuminate\Http\Request;

class AboutService
{
    private mixed $perPage;
    public function __construct()
    {
        $this->perPage = request()->get('limit', 12);
    }
    //getListAbout
    public function getListAbout()
    {
        return About::all();
    }
    //getListAboutByType
    public function getListAboutByType(Request $request, $select = ['*'])
    {
        return About::select($select)
            ->where('type', $request->type)
            ->orderBy('id', 'DESC')
            ->orderBy('about_order', 'DESC')
            ->get();

    }
    //getAbout
    public function getAbout(About $about, array $select = ['*'])
    {
        return About::select($select)
            ->where('id', $about->id)
            ->where('about_display', ABOUT::ABOUT_ACTIVE)
            ->first();
    }
}

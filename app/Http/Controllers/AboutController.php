<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\About;
use App\Http\Requests\AboutRequest;
use App\Http\Requests\FeeShipRequest;
use App\Models\City;

class AboutController extends Controller
{
    public function create()
    {
        return view('pages.about.add', [
            'title'      => 'Thêm mới thông tin',
        ]);
    }

    public function store(AboutRequest $request)
    {
        $about = new About;
        $about->about_name = $request->about_name;
        $about->about_slug = Str::slug($request->about_name);
        $about->type = $request->type;
        $about->about_order = $request->about_order;
        if ($request->about_display == 'on') {
            $about->about_display = 1;
        } else {
            $about->about_display = 0;
        }
        $about->about_desc = $request->about_desc;
        $about->about_content = $request->about_content;
        $about->seo_title = $request->seo_title;
        $about->seo_keyword = $request->seo_keyword;
        $about->seo_description = $request->seo_description;
        $about->save();

        return redirect('/about')->with('success', trans('alert.add.success'));
    }

    public function show($id)
    {
        $about = About::where('id', $id)->first();
        return view('pages.about.update', [
            'title' => 'Cập nhật thông tin',
            'about' => $about,
        ]);
    }

    public function update(AboutRequest $request, $id)
    {
        $about = About::find($id);
        $about->about_name = $request->about_name;
        $about->about_slug = Str::slug($request->about_name);
        $about->type = $request->type;
        $about->about_order = $request->about_order;
        if ($request->about_display == 'on') {
            $about->about_display = 1;
        } else {
            $about->about_display = 0;
        }
        $about->about_desc = $request->about_desc;
        $about->about_content = $request->about_content;
        $about->seo_title = $request->seo_title;
        $about->seo_keyword = $request->seo_keyword;
        $about->seo_description = $request->seo_description;
        $about->save();

        return redirect('/about')->with('success', trans('alert.update.success'));
    }

    public function index(Request $request)
    {
        $data = About::orderBy('id', 'desc')->where('type','!=','fee-ship')->paginate(20);
        if ($search = $request->search) {
            $data = About::orderBy('id', 'desc')->where('about_name', 'like', '%' . $search . '%')->paginate(20);
        }
        return view('pages.about.list', [
            'title'     => 'Danh sách thông tin',
            'data'      => $data
        ]);
    }

    public function delete($id)
    {
        $about = About::where('id', $id)->first();
        if ($about) {
            $about->delete();
        }
    }
    /**
     * dataFeeShip for dataTables
     *
     * @return Array
     */
    public function dataFeeShip()
    {
        $about = About::where('type', 'fee-ship')->get();
        foreach ($about as $k => $value) {
            if ($value->id_city > 0) {
                $id = explode(',', $value->id_city);
                $city = collect();
                foreach ($id as $i) {
                    $city->push(City::where('code', $i)->first());
                }
            } else {
                $abouts = About::select('id_city')->where('type', 'fee-ship')->where(function ($query) {
                    $query->where('id_city', '>', 0)
                        ->where('id_city', '!=', null)
                        ->where('id_city', '!=', '');
                })->get();
                $arr = [];
                foreach ($abouts as $ab) {
                    array_push($arr, $ab->id_city);
                }
                $rs = implode(',', $arr);
                $rss = explode(',', $rs);
                $city = City::whereNotIn('code', $rss)->get();
            }
            $value['transport_fee'] = $city->first();
            $value['city'] = $city;
        }
        $data['data'] = $about;
        return $data;
    }
    public function listFeeShip()
    {
        $feeship = About::where('type', 'fee-ship')->get();
        return view('pages.feeship.list', compact('feeship'));
    }
    public function getAddFeeShip()
    {
        $about = About::where('type', 'fee-ship')->get();
        $arr = [];
        foreach ($about as $ab) {
            array_push($arr, $ab->id_city);
        }
        $arrString = implode(',', $arr);
        $rs = explode(',', $arrString);
        $city = City::whereNotIn('code', $rs)->get();
        return view('pages.feeship.add', compact('city'));
    }
    public function storeAddFeeShip(FeeShipRequest $request)
    {
        $about = About::where('type', 'fee-ship')->where(function ($query) {
            $query->where('id_city', 0)
                ->orWhere('id_city', '')
                ->orWhere('id_city', null);
        })->first();
        if ($about != '' || !empty($about)) {
            About::find($about->id)->delete();
        }
        $id_city = 0;
        if ($request->id_city != '' || !empty($request->id_city || $request->id_city != null)) {
            $id_city = implode(',', $request->id_city);
        }
        $about = new About();
        $about->about_name = $request->about_name;
        $about->about_slug = Str::slug($request->about_name);
        $about->type = 'fee-ship';
        $about->id_city = $id_city;
        $about->save();
        if ($id_city != 0) {
            City::whereIn('code', $request->id_city)->update([
                'transport_fee' => $request->transport_fee
            ]);
        }
        return redirect(route('feeship.list'))->with('success', trans('alert.add.success'));
    }
    public function showFeeShip($id)
    {
        $feeship = About::where('type', 'fee-ship')->find($id);
        if ($feeship->id_city == 0 || $feeship->id_city == '' || $feeship->id_city == null) {
            $about = About::select('id_city')->where('type', 'fee-ship')->where(function ($query) {
                $query->where('id_city', '>', 0)
                    ->where('id_city', '!=', null)
                    ->where('id_city', '!=', '');
            })->get();
            $arr = [];
            foreach ($about as $ab) {
                array_push($arr, $ab->id_city);
            }
            $rs = implode(',', $arr);
            $rss = explode(',', $rs);
            $city = City::whereNotIn('code', $rss)->get();
            $feeship['transport_fee'] = $city->first();
            $feeship['city'] = $city;
        } else {
            $idct = explode(',', $feeship->id_city);
            $about = About::select('id_city')->where('type', 'fee-ship')->where(function ($query) {
                $query->where('id_city', '>', 0)
                    ->where('id_city', '!=', null)
                    ->where('id_city', '!=', '');
            })->get();
            $arr = [];
            foreach ($about as $ab) {
                array_push($arr, $ab->id_city);
            }
            $rs = implode(',', $arr);
            $rss = explode(',', $rs);
            foreach ($rss as $k => $vl) {
                if (array_search($vl, $idct) > -1) {
                    unset($rss[$k]);
                }
            }
            $city = City::whereNotIn('code', $rss)->get();
            $tran = City::where('code', $idct[0])->first();
            $feeship['transport_fee'] = $tran;
            $feeship['city'] = $city;
        }
        $id_citys = explode(',', $feeship->id_city);
        return view('pages.feeship.edit', compact('feeship', 'city', 'id_citys'));
    }
    public function updateFeeShip(FeeShipRequest $request, $id)
    {
        $about = About::find($id);
        $about->about_name = $request->about_name;
        $about->about_slug = Str::slug($request->about_name);
        $about->type = 'fee-ship';
        if ($request->has('id_city')) {
            $id_city = implode(',', $request->id_city);
            $about->id_city = $id_city;
            $about->save();
            City::whereIn('code', $request->id_city)->update([
                'transport_fee' => $request->transport_fee
            ]);
        } else {
            $abouts = About::select('id_city')->where('type', 'fee-ship')->where(function ($query) {
                $query->where('id_city', '>', 0)
                    ->where('id_city', '!=', null)
                    ->where('id_city', '!=', '');
            })->get();
            $arr = [];
            foreach ($abouts as $ab) {
                array_push($arr, $ab->id_city);
            }
            $rs = implode(',', $arr);
            $rss = explode(',', $rs);
            City::whereNotIn('code', $rss)->update([
                'transport_fee' => $request->transport_fee
            ]);
            $about->id_city = 0;
            $about->save();
        }
        return redirect(route('feeship.list'))->with('success', trans('alert.update.success'));
    }
    public function deleteFeeShip($id)
    {
        $about = About::find($id);
        if ($about) {
            $idcity = explode(',', $about->id_city);
            City::whereIn('code', $idcity)->update(
                ['transport_fee' => 0]
            );
            $about->delete();
        }
    }
}

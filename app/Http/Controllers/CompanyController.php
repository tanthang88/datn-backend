<?php
namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class CompanyController extends Controller
{
    //

    public function show()
    {
        $company = Company::first();
        return view('pages.info.edit',compact('company'));
    }
    public function update(CompanyRequest $request)
    {
        Company::truncate();
        $company = new Company();
        if($request->hasFile('company_favicon')){
            $name = $request->file('company_favicon')->getClientOriginalName();
            $pathFull = 'uploads/' . date("Y-m-d");

            $request->file('company_favicon')->storeAs(
                'public/' . $pathFull, $name
            );

            $thumb = '/storage/' . $pathFull . '/' . $name;
            $company->company_favicon = $thumb;
        }
        $company->company_name = $request->company_name;
        $company->company_slug = Str::slug($request->company_name);
        $company->company_address = $request->company_address;
        $company->company_hotline = $request->company_hotline;
        $company->company_phone = $request->company_phone;
        $company->company_email = $request->company_email;
        $company->company_fanpage = $request->company_fanpage;
        $company->company_copyright = $request->company_copyright;
        $company->company_work_day = $request->company_work_day;
        $company->company_work_time = $request->company_work_time;
        $company->company_ggmap = $request->company_ggmap;
        $company->company_gg_analytic = $request->company_gg_analytic;
        $company->seo_title = $request->seo_title;
        $company->seo_keyword = $request->seo_keyword;
        $company->seo_description = $request->seo_description;
        $company->save();
        return redirect(route('info.edit'))->with('success', trans('alert.update.success'));
    }
}

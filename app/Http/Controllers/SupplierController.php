<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class SupplierController extends Controller
{
    //
    
    public function getAdd()
    {

        return view('pages.supplier.add');
    }
    public function postAdd(Request $request)
    {
        $data = array();
        $data['supplier_name'] = $request->supplier_name;
        $data['supplier_photo'] = $request->supplier_photo;
        $data['supplier_order'] = $request->supplier_order;
        if($request->supplier_display=='on'){
            $data['supplier_display']=1;
        }else{
            $data['supplier_display']=0;
        }
        //$data['supplier_display'] = $request->supplier_display;
        if($request->supplier_outstanding=='on'){
            $data['supplier_outstanding']=1;
        }else{
            $data['supplier_outstanding']=0;
        }
      //  $data['supplier_outstanding'] = $request->supplier_outstanding;
        $data['supplier_desc'] = $request->supplier_desc;
        $data['supplier_address'] = $request->supplier_address;
        $data['supplier_map'] = $request->supplier_map;
        $data['supplier_phone'] = $request->supplier_phone;
        $data['supplier_email'] = $request->supplier_email;
        $data['created_at'] = NOW();
print_r($data);
        DB::table('suppliers')->insert($data);
        return Redirect::to('Supplier/List');
    }
    public function getUpdate($id)
    {
       $UpdateSL= DB::table('suppliers')->where('id', $id)->get();
       return view('pages.supplier.edit',[
        'UpdateSL' => $UpdateSL,
    ]);
    }
    public function postUpdate(Request $request, $id)
    {
        $supplier = Supplier::find($id);
        $supplier->supplier_name = $request->supplier_name;
       $supplier->supplier_photo = $request->supplier_photo;
       $supplier->supplier_order = $request->supplier_order;
       if($request->supplier_display=='on'){
        $supplier->supplier_display = 1;
    }else{
        $supplier->supplier_display = 0;
    }
    //$data['supplier_display'] = $request->supplier_display;
    if($request->supplier_display=='on'){
        $supplier->supplier_outstanding = 1;
    }else{
        $supplier->supplier_outstanding = 0;
    }
    $supplier->supplier_desc = $request->supplier_desc;
       $supplier->supplier_address = $request->supplier_address;
       $supplier->supplier_map = $request->supplier_map;
       $supplier->supplier_phone = $request->supplier_phone;
       $supplier->supplier_email = $request->supplier_email;
       $supplier->created_at = NOW();

     
       $supplier->save();
       return redirect('Supplier/List')->with('thongbao','Sửa thành công');
       

  
    }
    public function getList()
    {
        $supplier = DB::table('suppliers')->get();
        return view('pages.supplier.list',[
            'supplier' => $supplier,
        ]);
    }
    public function getDelete($id)
    {
       DB::table('suppliers')->where('id', $id)->delete();
       return Redirect::to('Supplier/List');
          }
}

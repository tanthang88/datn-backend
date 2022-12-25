<?php

namespace App\Http\Controllers;

use App\Http\Requests\Supplier\AddSupplierRequest;
use App\Http\Requests\Supplier\UpdateSupplierRequest;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class SupplierController extends Controller
{
    public function create()
    {
        return view('pages.supplier.add', [
            'title' => 'Thêm mới nhà cung cấp',
        ]);
    }
    public function store(AddSupplierRequest $request)
    {
        $data = array();
        $data['supplier_name'] = $request->supplier_name;
        if ($request->hasFile('supplier_photo')) {
            $name = $request->file('supplier_photo')->getClientOriginalName();
            $pathFull = 'uploads/' . date("Y-m-d");

            $request->file('supplier_photo')->storeAs(
                'public/' . $pathFull, $name
            );

            $thumb = '/storage/' . $pathFull . '/' . $name;
            $data['supplier_photo'] = $thumb;
        }
        $data['supplier_order'] = 1;
        if ($request->supplier_display == 'on') {
            $data['supplier_display'] = 1;
        } else {
            $data['supplier_display'] = 0;
        }
        if ($request->supplier_outstanding == 'on') {
            $data['supplier_outstanding'] = 1;
        } else {
            $data['supplier_outstanding'] = 0;
        }
        $data['supplier_desc'] = $request->supplier_desc;
        $data['supplier_address'] = $request->supplier_address;
        $data['supplier_map'] = $request->supplier_map;
        $data['supplier_phone'] = $request->supplier_phone;
        $data['supplier_email'] = $request->supplier_email;
        $data['created_at'] = NOW();
        DB::table('suppliers')->insert($data);
        return redirect('supplier/')->with('success', trans('alert.add.success'));
    }
    public function show($id)
    {
        $UpdateSL = DB::table('suppliers')->where('id', $id)->first();
        return view('pages.supplier.edit', [
            'title' => 'Chỉnh sửa nhà cung cấp',
            'UpdateSL' => $UpdateSL,
        ]);
    }
    public function update(UpdateSupplierRequest $request, $id)
    {
        $supplier = Supplier::find($id);
        $supplier->supplier_name = $request->supplier_name;
        if ($request->hasFile('supplier_photo')) {
            $name = $request->file('supplier_photo')->getClientOriginalName();
            $pathFull = 'uploads/' . date("Y-m-d");

            $request->file('supplier_photo')->storeAs(
                'public/' . $pathFull, $name
            );

            $thumb = '/storage/' . $pathFull . '/' . $name;
            $supplier->supplier_photo = $thumb;
        }
        $supplier->supplier_order = 1;
        if ($request->supplier_display == 'on') {
            $supplier->supplier_display = 1;
        } else {
            $supplier->supplier_display = 0;
        }
        if ($request->supplier_display == 'on') {
            $supplier->supplier_outstanding = 1;
        } else {
            $supplier->supplier_outstanding = 0;
        }
        $supplier->supplier_desc = $request->supplier_desc;
        $supplier->supplier_address = $request->supplier_address;
        $supplier->supplier_map = $request->supplier_map;
        $supplier->supplier_phone = $request->supplier_phone;
        $supplier->supplier_email = $request->supplier_email;
        $supplier->updated_at = NOW();
        $supplier->save();
        return redirect('supplier/')->with('success', trans('alert.update.success'));
    }
    public function index(Request $request)
    {
        $supplier = DB::table('suppliers')->orderBy('id', 'desc')->paginate(config('define.pagination.per_page'));
        if ($search = $request->search) {
            $supplier = Supplier::orderBy('id', 'desc')->orderBy('id', 'desc')->where('supplier_name', 'like', '%' . $search . '%')->paginate(config('define.pagination.per_page'));
        }
        return view('pages.supplier.list', [
            'title' => 'Danh sách nhà cung cấp',
            'supplier' => $supplier,
        ]);
    }
    public function delete($id)
    {
        DB::table('suppliers')->where('id', $id)->delete();
    }
}

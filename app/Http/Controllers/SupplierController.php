<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SupplierController extends Controller
{
    //
    //
    public function getAdd()
    {

        return view('pages.supplier.add');
    }
    public function postAdd(Request $request)
    {
    }
    public function getUpdate($id)
    {

    }
    public function postUpdate(Request $request, $id)
    {

    }
    public function getList()
    {
        return view('pages.supplier.list');
    }
    public function getDelete($id)
    {
    }
}

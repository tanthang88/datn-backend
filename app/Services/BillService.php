<?php

namespace App\Services;

use App\Http\Controllers\api\PaymentController;
use App\Models\Bill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BillService
{
    public function getBills()
    {
        return Bill::with('billDetails')
            ->where('customer_id', Auth::id())
            ->get();
    }

    public function getBill(Bill $bill, array $select = ['*'])
    {
        return Bill::select($select)
            ->with([
                'billDetails',
            ])
            ->where('customer_id', Auth::id())
            ->find($bill->id);
    }

    /**
     * create
     *
     * @param  Request $request
     * @return void
     */
    public function create(Request $request)
    {
        return DB::transaction(
            function () use ($request) {
                $id_user = Auth::id();
                $billData = [
                    'customer_id' => $id_user != '' ? $id_user : 0,// mgrate anhhv will update
                    'customer_name' => $request->customer_name,
                    'address' => $request->address,
                    'bill_phone' => $request->bill_phone,
                    'city_id' => $request->city_id,
                    'dist_id' => $request->dist_id,
                    'bill_price' => $request->bill_price,
                    'bill_status' => Bill::BILL_STATUS_WAITING_CONFIRM,
                    'bill_payment_status' => 0, //migrate  AnhHv will update
                    'discount_code_id' => $request->has('discount_code_id')?$request->discount_code_id:null //migrate Anhhv will update
                ];
                $bill = new Bill($billData);
                $bill->save();
                $billDetailData = [];
                foreach ($request->products as $product) {
                    $productData = [
                        'bill_id' => $bill->id,
                        'product_id' => $product["id"],
                        'price' => $product["price"],
                        'amount' => $product["amount"],
                        'into_price' => $product["into_price"],
                        'sale' => $product["sale"],
                        'fee' => $product["fee"],
                        'total' => $product["total"],
                        'variant_id' => $product['variant_id']!=null?$product['variant_id']:null //migrate Anhhv will update
                    ];
                    $billDetailData[] = $productData;
                }
                $bill->billDetails()->insert($billDetailData);
                if ($request->has('bank_code')) {
                    PaymentController::checkout(
                        [
                            'order_id' => $bill->id,
                            'total' =>  $bill->bill_price,
                            'bank_code' => $request->bank_code
                        ]
                    );
                } else {
                    echo json_encode(array(
                        'payment' => 'offline', 'code' => '', 'message' => 'success', 'data' => []
                    ));
                }
            }
        );
    }
}

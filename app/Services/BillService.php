<?php

namespace App\Services;

use App\Http\Controllers\Api\PaymentController;
use App\Models\Bill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BillService
{
    public function getBills()
    {
        return Bill::with([
            'billDetails.product:id,product_name,product_image',
        ])
            ->where('customer_id', Auth::id())
            ->get();
    }

    public function getBill(Bill $bill, array $select = ['*'])
    {
        return Bill::select($select)
            ->with([
                'billDetails.product:id,product_name,product_image',
                'city',
                'dist'
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
                    'customer_id' => $id_user != '' ? $id_user : 0, // mgrate anhhv will update
                    'customer_name' => $request->customer_name,
                    'address' => $request->address,
                    'bill_phone' => $request->bill_phone,
                    'city_id' => $request->city_id,
                    'dist_id' => $request->dist_id,
                    'bill_price' => $request->bill_price,
                    'bill_status' => Bill::BILL_STATUS_WAITING_CONFIRM,
                    'payment'=>$request->payment,
                ];
                $bill = new Bill($billData);
                $bill->save();
                $billDetailData = [];
                foreach ($request->products as $product) {
                    $productData = [
                        'bill_id' => $bill->id,
                        'product_id' => $product["id"],
                        'product_image' => $product["product_image"],
                        'product_name' => $product["product_name"],
                        'variant_name' => $product["variant_name"],
                        'price' => $product["product_price"],
                        'amount' => $product["quantity"],
                        'into_price' => $product["product_price"] * $product["quantity"],
                        'variant_id' => $product['variant_id'] != null ? $product['variant_id'] : null //migrate Anhhv will update
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

    public function cancel(Bill $bill)
    {
        return  DB::transaction(function () use ($bill) {
            return Bill::whereId($bill->id)
                ->where('bill_status', BILL::BILL_STATUS_WAITING_CONFIRM)
                ->update(['bill_status' => Bill::BILL_STATUS_CANCEL]);
        });
    }
}

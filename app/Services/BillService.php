<?php
namespace App\Services;

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
                $billData = [
                    'customer_id' => Auth::id(),
                    'customer_name' => $request->customer_name,
                    'address' => $request->address,
                    'bill_phone' => $request->bill_phone,
                    'city_id' => $request->city_id,
                    'dist_id' => $request->dist_id,
                    'bill_price' => $request->bill_price,
                    'bill_status' => Bill::BILL_STATUS_WAITING_CONFIRM,
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
                    ];
                    $billDetailData[] = $productData;
                }

                $bill->billDetails()->insert($billDetailData);
            }
        );
    }
}

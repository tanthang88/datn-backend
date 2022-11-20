<?php

namespace App\Services;

use App\Models\Promotion;
use App\Models\PromotionProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

class DiscountCodeService
{
    //getListDiscountCode
    public function getListDiscountCode()
    {
        return Promotion::select(['*'])
            ->with('promotionProduct')
            ->where('type', 'discount-code')
            ->where('promotion_status', 1)
            ->get();
    }
    //verification
    public function verification(Request $request, array $select = ['*'])
    {
        if ($request->has('id') || $request->has('total')) {
            return Promotion::select(['*'])->with('promotionProduct')->where('id', $request->id)->where('promotion_status',1)->get();
        }
    }
}

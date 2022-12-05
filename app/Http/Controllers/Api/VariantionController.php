<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\VariantionProductResource;
use App\Http\Resources\VariantionResource;
use App\Models\Promotion;
use App\Models\Product;
use App\Models\PromotionProduct;
use App\Models\Variantion;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class VariantionController extends Controller
{
    /**
     *
     *
     * @return JsonResponse
     */
    public function getVariantion(Product $product, Request $request)
    {
        try {
            if (strpos($request->id_link, ',') > -1) {
                $id_link = str_replace(',', ' ', $request->id_link) . ' ';
            } else {
                $id_link = $request->id_link . ' ';
            }
            $data = Variantion::where('propertie_id', $request->id)->where('product_id', $product->id)->where('propertie_id_link', $id_link)->first();
            $promotionProduct = PromotionProduct::with('promotion')->where('promotion_id_product', $product->id)->whereRelation('promotion', 'promotion_status', 1)->first();
            if ($promotionProduct && ($promotionProduct != '')) {
                $type = $promotionProduct->promotion->promotion_type;
                $rate = $promotionProduct->promotion_rate;
                if ($data == '') {
                    if ($type == 0) {
                        $money = ($product->product_price) * ((100 - $rate) / 100);
                    } else if ($type == 1) {
                        $money = ($product->product_price) - $rate;
                    }
                    $data = $product;
                    $data->id = null;
                    $data->price = $product->product_price;
                    $data->img = $product->product_image;
                } else {
                    if ($type == 0) {
                        $money = ($data->price) * ((100 - $rate) / 100);
                    } else if ($type == 1) {
                        $money = ($data->price) - $rate;
                    }
                    $data->rate = $rate;
                    $data->type = $type;
                    $data->sale = $money;
                }
            }
            if ($data == '') {
                $product->price = $product->product_price;
                $product->rate = null;
                $product->type = null;
                $product->sale = null;
                $product->img = null;
                $product->note2 = 'Sản phẩm này ko KM + Ko có biến thể =>lấy giá gốc';
                $listData = new VariantionProductResource($product);
            } else {
                $listData = new VariantionResource($data);
            }
            return $this->responseSuccess(['data' => $listData]);
        } catch (\Throwable $th) {
            Log::error("get variantion ", $th);
            return $this->responseError(
                array(trans('alert.product.failed')),
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}

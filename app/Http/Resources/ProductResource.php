<?php

namespace App\Http\Resources;

use App\Models\ProductCategories;
use App\Models\Promotion;
use App\Models\PromotionProduct;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    function showDealSock($id)
    {
        $dealSock = PromotionProduct::select('id', 'promotion_id_product', 'promotion_id_product_combo', 'promotion_id', 'promotion_rate', 'promotion_rate_combo')->with(['promotion' => function ($query) {
            $query->select('id', 'promotion_name', 'promotion_numer_of_use', 'promotion_numer_of_used', 'promotion_type', 'promotion_datestart', 'promotion_dateend');
        }, 'productCombo' => function ($query) {
            $query->select('id', 'product_name', 'product_image', 'product_price', 'product_quantity', 'product_desc');
        }])->whereRelation('promotion', 'type', '=', 'deal-sock')->whereRelation('promotion', 'promotion_status', 1)
            ->get();
        $collectPromotionDealSock = collect();
        foreach ($dealSock as $sock) {
            if ($sock->promotion_id_product == $id) {
                $collectPromotionDealSock->push($sock);
            }
        }
        if (($collectPromotionDealSock->count()) <= 0) {
            return null;
        } else {
            return $collectPromotionDealSock;
        }
    }
    public function toArray($request)
    {
        $promotion_product = $this->promotionProduct;
        $collectPromotionDiscount = collect();
        foreach ($promotion_product as $promotion) {
            $push = Promotion::select(['id', 'promotion_name', 'promotion_numer_of_use', 'promotion_numer_of_used', 'promotion_type', 'promotion_datestart', 'promotion_dateend'])->with('promotionProduct')->where('id', $promotion->promotion_id)->where('type', '=', 'discount')->where('promotion_status', 1)->first();
            if ($push == null) {
            } else {
                $collectPromotionDiscount->push($push);
            }
        }
        return [
            'id' => $this->id,
            'product_title' => $this->product_name,
            'product_slug' => $this->product_slug,
            'product_desc' => $this->product_desc,
            'product_price' => $this->product_price,
            'product_image' => $this->product_image,
            'product_configurations' => $this->productConfig,
            'is_variation' => $this->is_variation,
            'is_selling' => $this->is_selling,
            'product_outstanding' => $this->product_outstanding,
            'is_discount_product' => $this->is_discount_product,
            'discount_product' => $collectPromotionDiscount->first(),
            'dealsock_product' => $this->showDealSock($this->id),
            'properties' => $this->productPropertie,
            'category_name' => $this->productCategory?->category_name,
            'category_parent_id' => $this->productCategory?->parent_id,
        ];
    }
}

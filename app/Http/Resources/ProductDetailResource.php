<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $arrProperties = [];
        $arrs = $this->productPropertie;
        foreach ($arrs as $arr) {
            $slug = $arr->propertie_slug;
            array_push($arrProperties, $slug);
        }
        $arrProperties = array_unique($arrProperties);
        $rs =  array();
        $test = array();
        $j = 0;
        for ($i = 0; $i < count($arrs); $i++) {
            foreach ($arrProperties as $pr) {
                if ($pr == $arrs[$i]['propertie_slug']) {
                    $abc = array('propertie_value' => $arrs[$i]['propertie_value'], 'propertie_name' => $arrs[$i]['propertie_name'], 'id' => $arrs[$i]['id']);
                    array_push($test, $abc);
                    if ($j % 2 != 0) {
                        array_push($rs, $test);
                        $test = [];
                    }
                    $j++;
                }
            }
        }
        return [
            'id' => $this->id,
            'product_title' => $this->product_name,
            'product_desc' => $this->product_desc,
            'product_content' => $this->product_content,
            'product_slug' => $this->product_slug,
            'product_image' => $this->product_image,
            'product_quantity' => $this->product_quantity,
            'product_price' => $this->product_price,
            'product_promotion_desc' => $this->product_promotion_desc,
            'product_images' => $this->productImage,
            'product_configurations' => $this->productConfig,
            'is_variation' => $this->is_variation,
            'is_selling' => $this->is_selling,
            'product_outstanding' => $this->product_outstanding,
            'is_discount_product' => $this->is_discount_product,
            'properties' => $rs,
            'category_name' => $this->productCategory?->category_name,
            'category_parent_id' => $this->productCategory?->parent_id,
            'product_seo_title' => $this->seo_title,
            'product_seo_keyword' => $this->seo_keyword,
            'product_seo_description' => $this->seo_description,
        ];
    }
}

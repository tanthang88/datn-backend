<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductCategories;
use Illuminate\Http\Request;

class ProductFilterService
{
    private mixed $perPage;
    public function __construct()
    {
        $this->perPage = request()->get('limit', 12);
    }

    /**
     * getListFilter
     *
     * @return void
     */
    public function getListFilter()
    {

        $data = [
            [
                'id' => 1,
                'filter_title' => 'Giá',
                'filter_name' => 'price',
                'fields' => [
                    [
                        'field_label' => 'Dưới 2 triệu',
                        'field_slug' => 'duoi-2-trieu',
                        'field_value' => '<2000000'
                    ],
                    [
                        'field_label' => 'Từ 2-4 triệu',
                        'field_slug' => 'tu-2-4-trieu',
                        'field_value' => '2000000<>4000000'
                    ],
                    [
                        'field_label' => 'Từ 4-7 triệu',
                        'field_slug' => 'tu-4-7-trieu',
                        'field_value' => '4000000<>7000000'
                    ],
                    [
                        'field_label' => 'Từ 7-13 triệu',
                        'field_slug' => 'tu-7-13-trieu',
                        'field_value' => '7000000<>13000000'
                    ],
                    [
                        'field_label' => 'Trên 13 triệu',
                        'field_slug' => 'tren-13-trieu',
                        'field_value' => '>13000000'
                    ]
                ],
            ],
            [
                'id' => 2,
                'filter_title' => 'Hiệu năng và Pin',
                'filter_name' => 'battery',
                'fields' => [
                    [
                        'field_label' => 'Dưới 3000 mah',
                        'field_slug' => 'duoi-3000-mah',
                        'field_value' => '<3000'
                    ],
                    [
                        'field_label' => 'Từ  3000 - 4000 mah',
                        'field_slug' => 'tu-3000-4000-mah',
                        'field_value' => '3000<>4000'
                    ],
                    [
                        'field_label' => 'Từ  4000 - 5000 mah',
                        'field_slug' => 'tu-4000-5000-mah',
                        'field_value' => '4000<>5000'
                    ],
                    [
                        'field_label' => 'Trên 5000 mah',
                        'field_slug' => 'tren-5000-mah',
                        'field_value' => '>5000'
                    ]
                ]
            ],
            [
                'id' => 3,
                'filter_title' => 'Màn hình',
                'filter_name' => 'screen',
                'fields' => [
                    [
                        'field_label' => 'Màn hình nhỏ: dưới 5.0 inch',
                        'field_slug' => 'man-hinh-nho:-duoi-5.0-inch',
                        'field_value' => '<5'
                    ],
                    [
                        'field_label' => 'Nhỏ gọn vừa tay: dưới 6.0 inch ,tràn viền',
                        'field_slug' => 'nho-gon-vua-tay:-duoi-6.0-inch-,-tran-vien',
                        'field_value' => '5<>6'
                    ],
                    [
                        'field_label' => 'Trên 6.0 inch',
                        'field_slug' => 'tren-6.0-inch',
                        'field_value' => '>6'
                    ]
                ]
            ],
            [
                'id' => 4,
                'filter_title' => 'Camera',
                'filter_name' => 'camera',
                'fields' => [
                    [
                        'field_label' => '12 MP',
                        'field_slug' => '12-mp',
                        'field_value' => '=12'
                    ],
                    [
                        'field_label' => '32 MP',
                        'field_slug' => '32-mp',
                        'field_value' => '=32'
                    ],
                    [
                        'field_label' => '48 MP',
                        'field_slug' => '48-mp',
                        'field_value' => '=48'
                    ]
                ]
            ]
        ];
        return $data;
    }
    /**
     * getListFilter
     *
     * @return void
     */
    public function getListSortBy()
    {

        $data = [
            [
                'id' => 1,
                'sort_title' => 'Bán chạy nhất',
                'sort_name' => 'bestselling',
                'field_value' => '1'
            ],
            [
                'id' => 2,
                'sort_title' => 'Giá thấp',
                'sort_name' => 'orderby',
                'field_value' => 'asc'
            ],
            [
                'id' => 3,
                'sort_title' => 'Giá cao',
                'sort_name' => 'orderby',
                'field_value' => 'desc'
            ]
        ];
        return $data;
    }
    /**
     * getListProductByCategory
     *

     * @param  Request $request

     *
     *
     * @return Object
     */
    public function getListProductFilter(Request $request, $select = ['products.id','product_name','product_slug','product_image','product_quantity','product_desc','product_promotion_desc','is_discount_product','product_price','config_battery','config_screen','config_camera','is_selling','rating'])
    {
        return Product::select($select)->join('configurations','products.id','=','configurations.product_id')
        ->where('category_id', $request->categories)
        ->when($request->has('price'), function ($query) use($request)  {
            $this->checkParamFilter($query,'product_price',$request->price);
        })
        ->when($request->has('battery'), function ($query) use($request)  {
            $this->checkParamFilter($query,'config_battery', $request->battery);
        })
        ->when($request->has('screen'), function ($query) use($request)  {
            $this->checkParamFilter($query,'config_screen', $request->screen);
        })
        ->when($request->has('camera'), function ($query) use($request)  {
            $this->checkParamFilter($query,'config_camera', $request->camera);
        })
        ->when($request->has('rating'), function ($query) use($request)  {
            $this->checkParamFilter($query,'rating', $request->rating);
        })
        ->when($request->has('bestselling'), function ($query) use($request)  {
            $query->where('is_selling',$request->bestselling);
        })
        ->when($request->has('orderby'), function ($query) use($request)  {
            $query->orderby('product_price',$request->orderby);
        })
        ->where('product_display', PRODUCT::PRODUCT_ACTIVE)
        ->paginate($this->perPage);
    }

    public function checkParamFilter($query,$field,$value){

        if (preg_match("/^([0-9\.]+)$/", $value)) {
           $query->where($field,$value);
        }else if(preg_match("/^([0-9\.]+<>[0-9\.]+)$/", $value)){
            $vl=str_replace('<>', ',', $value);
            $vl=explode(',', $vl);
            $query->whereBetween($field,$vl);
        }else  if(preg_match("/^<[0-9\.]+$/", $value)){
            $vl=str_replace('<', '', $value);
            $query->where($field,'<',$vl);
        }else  if(preg_match("/^>[0-9\.]+$/", $value)){
            $vl=str_replace('>', '', $value);
            $query->where($field,'>',$vl);
        }
    }
}

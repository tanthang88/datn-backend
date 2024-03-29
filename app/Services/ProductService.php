<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductCategories;

class ProductService
{
    private mixed $perPage;
    public function __construct()
    {
        $this->perPage = request()->get('limit', 12);
    }

    /**
     * getListCate
     *
     * @return void
     */
    public function getListCategory()
    {
        return ProductCategories::where('parent_id', 0)
            ->with(['children' => function ($query) {
                $query->with(['children']);
            }])
            ->get();
    }
    //  getListProduct

    public function getListProduct()
    {
        return Product::select('*')->paginate($this->perPage);
    }
    /**
     * getListProductByCategory
     *
     * @param  ProductCategories$category
     * @param  $select
     * @return Object
     */
    public function getListProductByCategory(ProductCategories $category, $select = ['*'])
    {
        return Product::select($select)
            ->with('productCategory')
            ->when(!empty($category), function ($query) use ($category) {
                $query->where('category_id', $category->id);
            })
            ->when(!empty($category), function ($query) {
                $query->where('product_display', PRODUCT::PRODUCT_ACTIVE);
            })
            ->orderBy('id', 'DESC')
            ->orderBy('product_order', 'DESC')
            ->paginate($this->perPage);
    }

    /**
     * getProduct
     *
     * @param  Product $product
     * @param  array $select
     * @return Object
     */
    public function getProduct(Product $product, array $select = ['*'])
    {
        return Product::select($select)
            ->where('id', $product->id)
            ->where('product_display', PRODUCT::PRODUCT_ACTIVE)
            ->first();
    }

    /**
     * getListProductsRelated
     *
     * @param  Product $product
     * @return Response
     */
    public function getListProductsRelated(Product $product)
    {
        return Product::select(['*'])
            ->with('productCategory')
            ->where('product_display', PRODUCT::PRODUCT_ACTIVE)
            ->where('category_id', $product->category_id)
            ->get();
    }
}

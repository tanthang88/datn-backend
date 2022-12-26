<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductComment;
use Illuminate\Http\Request;

class ProductCommentService
{

    /**
     * getListComment
     *
     * @param  Product $product
     * @return Response
     */
    public function getListComment(Product $product)
    {
        return ProductComment::orderBy('id', 'desc')
            ->with([
                'childrenComment',
                'customer',
            ])
            ->where('product_id', $product->id)
            ->where('parent_id', 0)
            ->where('comment_display', config('define.display.show'))
            ->get();
    }

    /**
     * createComment
     *
     * @param  Product $product
     * @param  Request $request
     * @return ProductComment
     */
    public function createComment(Product $product, Request $request)
    {
        $data = [];
        if (!empty($request->customer_id)) {
            $data['customer_id'] = $request->customer_id;
        }
        $data['product_id'] = $product->id;
        $data['comment_name'] = $request->comment_name;
        $data['comment_email'] = $request->comment_email;
        $data['comment_phone'] = $request->comment_phone;
        $data['comment_content'] = $request->comment_content;

        $productComment = ProductComment::create($data);
        return $productComment;
    }
}
